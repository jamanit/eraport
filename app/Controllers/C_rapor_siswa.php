<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_rapor_siswa;
use App\Models\M_siswa;
use App\Models\M_kelas;
use App\Models\M_nilai_siswa;
use App\Models\M_mata_pelajaran;
use App\Models\M_ekstra_kurikuler;
use App\Models\M_kepribadian;
use App\Models\M_absensi;

class C_rapor_siswa extends Controller
{
    protected $helpers = ['form'];
    protected $session;
    protected $M_rapor_siswa;
    protected $M_siswa;
    protected $M_kelas;
    protected $M_nilai_siswa;
    protected $M_mata_pelajaran;
    protected $M_ekstra_kurikuler;
    protected $M_kepribadian;
    protected $M_absensi;

    public function __construct()
    {
        $this->session            = session();
        $this->M_rapor_siswa      = new M_rapor_siswa();
        $this->M_siswa            = new M_siswa();
        $this->M_kelas            = new M_kelas();
        $this->M_nilai_siswa      = new M_nilai_siswa();
        $this->M_mata_pelajaran   = new M_mata_pelajaran();
        $this->M_ekstra_kurikuler = new M_ekstra_kurikuler();
        $this->M_kepribadian      = new M_kepribadian();
        $this->M_absensi          = new M_absensi();
    }

    public function index()
    {
        $data['title'] = 'Daftar Data Rapor Siswa';

        // Mulai query untuk mengambil jadwal pelajaran
        $builder = $this->M_kelas
            ->select(
                'tb_kelas.id as id_kelas, tb_kelas.nama_kelas,
                tb_tahun_ajaran.id as id_tahun_ajaran, tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.semester,
                tb_pengguna.id as id_guru_wali, tb_pengguna.nama as nama_guru_wali'
            )
            ->join('tb_tahun_ajaran', 'tb_kelas.id_tahun_ajaran = tb_tahun_ajaran.id', 'left')
            ->join('tb_pengguna', 'tb_kelas.id_guru_Wali = tb_pengguna.id', 'left')
            ->orderBy('tb_tahun_ajaran.tahun_ajaran', 'desc')
            ->orderBy('tb_tahun_ajaran.semester', 'desc')
            ->orderBy('tb_kelas.nama_kelas', 'asc')
            ->orderBy('tb_pengguna.nama', 'asc');

        // Jika id_login bukan '1', tambahkan kondisi where untuk membatasi berdasarkan id_guru
        $id_login = (session()->get('loggedUser')['id'] ?? 'ID');
        if ($id_login != '1') {
            $builder->where('tb_pengguna.id', $id_login);
        }

        // Ambil hasil query
        $data['kelas'] = $builder->findAll();

        return view('rapor-siswa/V-index-rapor-siswa', $data);
    }

    public function list($id_kelas)
    {
        $data['title'] = 'Daftar Data Rapor Siswa';

        $data['kelas'] = $this->M_kelas
            ->select('tb_kelas.id as id_kelas, tb_kelas.nama_kelas, tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.semester')
            ->join('tb_tahun_ajaran', 'tb_kelas.id_tahun_ajaran = tb_tahun_ajaran.id', 'id')
            ->find($id_kelas);

        $data['rapor_siswa'] = $this->M_rapor_siswa
            ->select(
                'tb_rapor_siswa.id as id_rapor_siswa, tb_rapor_siswa.catatan, tb_rapor_siswa.hasil_keputusan,
                tb_siswa.id as id_siswa, tb_siswa.nama_siswa'
            )
            ->join('tb_siswa', 'tb_rapor_siswa.id_siswa = tb_siswa.id', 'left')
            ->where('tb_rapor_siswa.id_kelas', $id_kelas)
            ->orderBy('tb_siswa.nama_siswa', 'asc')
            ->findAll();

        $data['siswa'] = $this->M_siswa->where('id_kelas', $id_kelas)->orderBy('nama_siswa', 'asc')->findAll();

        return view('rapor-siswa/V-list-rapor-siswa', $data);
    }

    public function get_siswa($id_kelas)
    {
        $data['kelas'] = $this->M_kelas
            ->select('tb_kelas.id as id_kelas, tb_kelas.nama_kelas, tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.semester')
            ->join('tb_tahun_ajaran', 'tb_kelas.id_tahun_ajaran = tb_tahun_ajaran.id', 'id')
            ->find($id_kelas);

        $data['rapor_siswa'] = $this->M_rapor_siswa
            ->select(
                'tb_rapor_siswa.id as id_rapor_siswa, tb_rapor_siswa.catatan, tb_rapor_siswa.hasil_keputusan,
                tb_siswa.id as id_siswa, tb_siswa.nama_siswa'
            )
            ->join('tb_siswa', 'tb_rapor_siswa.id_siswa = tb_siswa.id', 'left')
            ->where('tb_rapor_siswa.id_kelas', $id_kelas)
            ->orderBy('tb_siswa.nama_siswa', 'asc')
            ->findAll();

        if (empty($data['rapor_siswa'])) {
            $data['siswa'] = $this->M_siswa
                ->where('tb_siswa.id_kelas', $id_kelas)
                ->orderBy('tb_siswa.nama_siswa', 'asc')
                ->findAll();

            if (empty($data['siswa'])) {
                // Jika tidak ada siswa terdaftar di kelas ini
                $this->session->setFlashdata('error', 'Tidak ada siswa yang terdaftar pada kelas ini.');
                return redirect()->back();  // Kembali ke halaman sebelumnya
            }

            // 3. Masukkan data absensi baru untuk setiap siswa dengan status null
            foreach ($data['siswa'] as $siswa) {
                // Cek apakah siswa sudah ada absensinya pada tanggal tersebut
                $existingRaporSIswa = $this->M_rapor_siswa
                    ->where('id_kelas', $id_kelas)
                    ->where('id_siswa', $siswa['id'])
                    ->first();  // Mengambil 1 data jika ada

                // Jika absensi tidak ada, insert ke tabel absensi
                if (!$existingRaporSIswa) {
                    $this->M_rapor_siswa->insert([
                        'id_kelas' => $id_kelas,
                        'id_siswa' => $siswa['id'],
                    ]);
                }
            }
        }

        return redirect()->to('/rapor-siswa/list/' . $id_kelas);
    }

    public function show($id_rapor_siswa)
    {
        $data['title'] = 'Data Rapor Siswa';

        $data['rapor_siswa'] = $this->M_rapor_siswa
            ->select(
                'tb_rapor_siswa.id as id_rapor_siswa, tb_rapor_siswa.catatan, tb_rapor_siswa.hasil_keputusan,
            tb_kelas.id as id_kelas, tb_kelas.nama_kelas,
            tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.semester,
            tb_siswa.id as id_siswa, tb_siswa.nama_siswa, tb_siswa.nisn'
            )
            ->join('tb_kelas', 'tb_rapor_siswa.id_kelas = tb_kelas.id', 'left')
            ->join('tb_tahun_ajaran', 'tb_kelas.id_tahun_ajaran = tb_tahun_ajaran.id', 'left')
            ->join('tb_siswa', 'tb_rapor_siswa.id_siswa = tb_siswa.id', 'left')
            ->find($id_rapor_siswa);

        $data['nilai_siswa'] = $this->M_nilai_siswa
            ->select('tb_nilai_siswa.id as id_nilai_siswa, tb_nilai_siswa.kkm, tb_nilai_siswa.nilai_hasil_pengetahuan_angka, tb_nilai_siswa.nilai_hasil_pengetahuan_huruf, tb_nilai_siswa.nilai_hasil_praktik_angka, tb_nilai_siswa.nilai_hasil_praktik_huruf, tb_nilai_siswa.sikap_efektif_predikat, 
                    tb_mata_pelajaran.id as id_mapel, tb_mata_pelajaran.nama_mapel,
                    tb_siswa.id as id_siswa, tb_siswa.nama_siswa')
            ->join('tb_mata_pelajaran', 'tb_nilai_siswa.id_mapel = tb_mata_pelajaran.id', 'left')
            ->join('tb_siswa', 'tb_nilai_siswa.id_siswa = tb_siswa.id', 'left')
            ->where('id_siswa', $data['rapor_siswa']['id_siswa'])
            ->orderBy('tb_mata_pelajaran.nama_mapel', 'asc')
            ->findAll();

        $data['ekstra_kurikuler'] = $this->M_ekstra_kurikuler
            ->where('id_rapor_siswa',  $data['rapor_siswa']['id_rapor_siswa'])
            ->first();

        $data['kepribadian'] = $this->M_kepribadian
            ->where('id_rapor_siswa',  $data['rapor_siswa']['id_rapor_siswa'])
            ->first();

        // Query untuk mendapatkan jumlah absensi per status
        // $data['absensi'] = $this->M_absensi
        //     ->select('tb_absensi.id as id_absensi, tb_absensi.status')
        //     ->join('tb_jadwal_pelajaran', 'tb_absensi.id_jadwal_pelajaran = tb_jadwal_pelajaran.id', 'left')
        //     ->where('tb_absensi.id_siswa', $data['rapor_siswa']['id_siswa'])
        //     ->where('tb_jadwal_pelajaran.id_kelas', $data['rapor_siswa']['id_kelas'])
        //     ->findAll();

        $data['absensi'] = $this->M_absensi
            ->select('tb_absensi.status, COUNT(tb_absensi.status) as jumlah')
            ->join('tb_jadwal_pelajaran', 'tb_absensi.id_jadwal_pelajaran = tb_jadwal_pelajaran.id', 'left')
            ->where('tb_absensi.id_siswa', $data['rapor_siswa']['id_siswa'])
            ->where('tb_jadwal_pelajaran.id_kelas', $data['rapor_siswa']['id_kelas'])
            ->groupBy('tb_absensi.status')
            ->findAll();

        $absensi = [
            'hadir' => 0,
            'sakit' => 0,
            'izin' => 0,
            'tanpa_keterangan' => 0,
        ];

        foreach ($data['absensi'] as $row) {
            switch ($row['status']) {
                case 'Hadir':
                    $absensi['hadir'] = $row['jumlah'];
                    break;
                case 'Sakit':
                    $absensi['sakit'] = $row['jumlah'];
                    break;
                case 'Izin':
                    $absensi['izin'] = $row['jumlah'];
                    break;
                case 'Tanpa Keterangan':
                    $absensi['tanpa_keterangan'] = $row['jumlah'];
                    break;
            }
        }

        $data['absensi'] = $absensi;

        return view('rapor-siswa/V-show-rapor-siswa', $data);
    }

    public function save_ekstra_kurikuler()
    {
        // Ambil data yang dikirim dari form 
        $id_rapor_siswa      = $this->request->getPost('id_rapor_siswa');
        $id_ekstra_kurikuler = $this->request->getPost('id_ekstra_kurikuler');
        $jenis_kegiatan_1    = $this->request->getPost('jenis_kegiatan_1');
        $nilai_1             = $this->request->getPost('nilai_1');
        $jenis_kegiatan_2    = $this->request->getPost('jenis_kegiatan_2');
        $nilai_2             = $this->request->getPost('nilai_2');
        $jenis_kegiatan_3    = $this->request->getPost('jenis_kegiatan_3');
        $nilai_3             = $this->request->getPost('nilai_3');
        $jenis_kegiatan_4    = $this->request->getPost('jenis_kegiatan_4');
        $nilai_4             = $this->request->getPost('nilai_4');

        // Siapkan data untuk insert/update
        $data = [
            'id_rapor_siswa'   => $id_rapor_siswa,
            'jenis_kegiatan_1' => $jenis_kegiatan_1,
            'nilai_1'          => $nilai_1,
            'jenis_kegiatan_2' => $jenis_kegiatan_2,
            'nilai_2'          => $nilai_2,
            'jenis_kegiatan_3' => $jenis_kegiatan_3,
            'nilai_3'          => $nilai_3,
            'jenis_kegiatan_4' => $jenis_kegiatan_4,
            'nilai_4'          => $nilai_4
        ];

        // Cek apakah id_ekstra_kurikuler ada
        if (!empty($id_ekstra_kurikuler)) {
            // Jika id_ekstra_kurikuler ada, lakukan update
            $this->M_ekstra_kurikuler->update($id_ekstra_kurikuler, $data);
        } else {
            // Jika id_ekstra_kurikuler kosong, lakukan insert
            $this->M_ekstra_kurikuler->insert($data);
        }

        session()->setFlashdata('success', 'Data ekstra kurikuler berhasil disimpan.');

        // Redirect kembali setelah proses selesai
        return redirect()->back();
    }

    public function save_kepribadian()
    {
        // Ambil data yang dikirim dari form 
        $id_rapor_siswa = $this->request->getPost('id_rapor_siswa');
        $id_kepribadian = $this->request->getPost('id_kepribadian');
        $aspek_1        = $this->request->getPost('aspek_1');
        $keterangan_1   = $this->request->getPost('keterangan_1');
        $aspek_2        = $this->request->getPost('aspek_2');
        $keterangan_2   = $this->request->getPost('keterangan_2');
        $aspek_3        = $this->request->getPost('aspek_3');
        $keterangan_3   = $this->request->getPost('keterangan_3');
        $aspek_4        = $this->request->getPost('aspek_4');
        $keterangan_4   = $this->request->getPost('keterangan_4');

        // Siapkan data untuk insert/update
        $data = [
            'id_rapor_siswa' => $id_rapor_siswa,
            'aspek_1'        => $aspek_1,
            'keterangan_1'   => $keterangan_1,
            'aspek_2'        => $aspek_2,
            'keterangan_2'   => $keterangan_2,
            'aspek_3'        => $aspek_3,
            'keterangan_3'   => $keterangan_3,
            'aspek_4'        => $aspek_4,
            'keterangan_4'   => $keterangan_4
        ];

        // Cek apakah id_kepribadian ada
        if (!empty($id_kepribadian)) {
            // Jika id_kepribadian ada, lakukan update
            $this->M_kepribadian->update($id_kepribadian, $data);
        } else {
            // Jika id_kepribadian kosong, lakukan insert
            $this->M_kepribadian->insert($data);
        }

        session()->setFlashdata('success', 'Data kepribadian berhasil disimpan.');

        // Redirect kembali setelah proses selesai
        return redirect()->back();
    }

    public function save_catatan()
    {
        // Ambil data yang dikirim dari form 
        $id_rapor_siswa = $this->request->getPost('id_rapor_siswa');
        $catatan        = $this->request->getPost('catatan');

        // Siapkan data untuk insert/update
        $data = [
            'catatan' => $catatan,
        ];

        // Cek apakah id_rapor_siswa ada
        if (!empty($id_rapor_siswa)) {
            // Jika id_rapor_siswa ada, lakukan update
            $this->M_rapor_siswa->update($id_rapor_siswa, $data);
        } else {
            // Jika id_rapor_siswa kosong, lakukan insert
            $this->M_rapor_siswa->insert($data);
        }

        session()->setFlashdata('success', 'Data catatan berhasil disimpan.');

        // Redirect kembali setelah proses selesai
        return redirect()->back();
    }

    public function save_keputusan()
    {
        // Ambil data yang dikirim dari form 
        $id_rapor_siswa  = $this->request->getPost('id_rapor_siswa');
        $hasil_keputusan = $this->request->getPost('hasil_keputusan');

        // Siapkan data untuk insert/update
        $data = [
            'hasil_keputusan' => $hasil_keputusan,
        ];

        // Cek apakah id_rapor_siswa ada
        if (!empty($id_rapor_siswa)) {
            // Jika id_rapor_siswa ada, lakukan update
            $this->M_rapor_siswa->update($id_rapor_siswa, $data);
        } else {
            // Jika id_rapor_siswa kosong, lakukan insert
            $this->M_rapor_siswa->insert($data);
        }

        session()->setFlashdata('success', 'Data hasil keputusan berhasil disimpan.');

        // Redirect kembali setelah proses selesai
        return redirect()->back();
    }

    public function print($id_rapor_siswa)
    {
        $data['rapor_siswa'] = $this->M_rapor_siswa
            ->select(
                'tb_rapor_siswa.id as id_rapor_siswa, tb_rapor_siswa.catatan, tb_rapor_siswa.hasil_keputusan,
        tb_kelas.id as id_kelas, tb_kelas.nama_kelas,
        tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.semester,
        tb_siswa.id as id_siswa, tb_siswa.nama_siswa, tb_siswa.nisn'
            )
            ->join('tb_kelas', 'tb_rapor_siswa.id_kelas = tb_kelas.id', 'left')
            ->join('tb_tahun_ajaran', 'tb_kelas.id_tahun_ajaran = tb_tahun_ajaran.id', 'left')
            ->join('tb_siswa', 'tb_rapor_siswa.id_siswa = tb_siswa.id', 'left')
            ->find($id_rapor_siswa);

        $data['nilai_siswa'] = $this->M_nilai_siswa
            ->select('tb_nilai_siswa.id as id_nilai_siswa, tb_nilai_siswa.kkm, tb_nilai_siswa.nilai_hasil_pengetahuan_angka, tb_nilai_siswa.nilai_hasil_pengetahuan_huruf, tb_nilai_siswa.nilai_hasil_praktik_angka, tb_nilai_siswa.nilai_hasil_praktik_huruf, tb_nilai_siswa.sikap_efektif_predikat, 
                tb_mata_pelajaran.id as id_mapel, tb_mata_pelajaran.nama_mapel,
                tb_siswa.id as id_siswa, tb_siswa.nama_siswa')
            ->join('tb_mata_pelajaran', 'tb_nilai_siswa.id_mapel = tb_mata_pelajaran.id', 'left')
            ->join('tb_siswa', 'tb_nilai_siswa.id_siswa = tb_siswa.id', 'left')
            ->where('id_siswa', $data['rapor_siswa']['id_siswa'])
            ->orderBy('tb_mata_pelajaran.nama_mapel', 'asc')
            ->findAll();

        $data['ekstra_kurikuler'] = $this->M_ekstra_kurikuler
            ->where('id_rapor_siswa',  $data['rapor_siswa']['id_rapor_siswa'])
            ->first();

        $data['kepribadian'] = $this->M_kepribadian
            ->where('id_rapor_siswa',  $data['rapor_siswa']['id_rapor_siswa'])
            ->first();

        // Query untuk mendapatkan jumlah absensi per status
        // $data['absensi'] = $this->M_absensi
        //     ->select('tb_absensi.id as id_absensi, tb_absensi.status')
        //     ->join('tb_jadwal_pelajaran', 'tb_absensi.id_jadwal_pelajaran = tb_jadwal_pelajaran.id', 'left')
        //     ->where('tb_absensi.id_siswa', $data['rapor_siswa']['id_siswa'])
        //     ->where('tb_jadwal_pelajaran.id_kelas', $data['rapor_siswa']['id_kelas'])
        //     ->findAll();

        $data['absensi'] = $this->M_absensi
            ->select('tb_absensi.status, COUNT(tb_absensi.status) as jumlah')
            ->join('tb_jadwal_pelajaran', 'tb_absensi.id_jadwal_pelajaran = tb_jadwal_pelajaran.id', 'left')
            ->where('tb_absensi.id_siswa', $data['rapor_siswa']['id_siswa'])
            ->where('tb_jadwal_pelajaran.id_kelas', $data['rapor_siswa']['id_kelas'])
            ->groupBy('tb_absensi.status')
            ->findAll();

        $absensi = [
            'hadir' => 0,
            'sakit' => 0,
            'izin' => 0,
            'tanpa_keterangan' => 0,
        ];

        foreach ($data['absensi'] as $row) {
            switch ($row['status']) {
                case 'Hadir':
                    $absensi['hadir'] = $row['jumlah'];
                    break;
                case 'Sakit':
                    $absensi['sakit'] = $row['jumlah'];
                    break;
                case 'Izin':
                    $absensi['izin'] = $row['jumlah'];
                    break;
                case 'Tanpa Keterangan':
                    $absensi['tanpa_keterangan'] = $row['jumlah'];
                    break;
            }
        }

        $data['absensi'] = $absensi;

        return view('rapor-siswa/V-print-rapor-siswa', $data);
    }
}
