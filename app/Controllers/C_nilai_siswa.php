<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_jadwal_pelajaran;
use App\Models\M_kelas;
use App\Models\M_nilai_siswa;
use App\Models\M_mata_pelajaran;
use App\Models\M_siswa;

class C_nilai_siswa extends Controller
{
    protected $helpers = ['form'];
    protected $session;
    protected $M_jadwal_pelajaran;
    protected $M_nilai_siswa;
    protected $M_kelas;
    protected $M_mata_pelajaran;
    protected $M_siswa;

    public function __construct()
    {
        $this->session            = session();
        $this->M_jadwal_pelajaran = new M_jadwal_pelajaran();
        $this->M_kelas            = new M_kelas();
        $this->M_nilai_siswa      = new M_nilai_siswa();
        $this->M_mata_pelajaran   = new M_mata_pelajaran();
        $this->M_siswa            = new M_siswa();
    }

    public function index()
    {
        $data['title']            = 'Daftar Data Nilai Siswa';

        // Mulai query untuk mengambil jadwal pelajaran
        $builder = $this->M_jadwal_pelajaran
            ->select(
                'tb_jadwal_pelajaran.id as id_jadwal_pelajaran, 
        tb_jadwal_pelajaran.hari, tb_jadwal_pelajaran.jam_ke,
        tb_kelas.id as id_kelas, tb_kelas.nama_kelas,
        tb_mata_pelajaran.id as id_mapel, tb_mata_pelajaran.nama_mapel,
        tb_tahun_ajaran.id as id_tahun_ajaran, tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.semester,
        tb_pengguna.id as id_guru, tb_pengguna.nama as nama_guru'
            )
            ->join('tb_kelas', 'tb_jadwal_pelajaran.id_kelas = tb_kelas.id', 'left')
            ->join('tb_mata_pelajaran', 'tb_jadwal_pelajaran.id_mapel = tb_mata_pelajaran.id', 'left')
            ->join('tb_tahun_ajaran', 'tb_kelas.id_tahun_ajaran = tb_tahun_ajaran.id', 'left')
            ->join('tb_pengguna', 'tb_mata_pelajaran.id_guru = tb_pengguna.id', 'left')
            ->orderBy('tb_tahun_ajaran.tahun_ajaran', 'desc')
            ->orderBy('tb_tahun_ajaran.semester', 'desc')
            ->orderBy('tb_kelas.nama_kelas', 'asc')
            ->orderBy('tb_mata_pelajaran.nama_mapel', 'asc')
            ->orderBy('tb_pengguna.nama', 'asc');

        // Jika id_login bukan '1', tambahkan kondisi where untuk membatasi berdasarkan id_guru
        $id_login = (session()->get('loggedUser')['id'] ?? 'ID');
        if ($id_login != '1') {
            $builder->where('tb_pengguna.id', $id_login);
        }

        // Ambil hasil query
        $data['jadwal_pelajaran'] = $builder->findAll();

        return view('nilai-siswa/V-index-nilai-siswa', $data);
    }

    public function edit($id_kelas, $id_mapel)
    {
        $data['title'] = 'Ubah Data Nilai Siswa';

        $data['kelas'] = $this->M_kelas
            ->select('tb_kelas.id as id_kelas, tb_kelas.nama_kelas, tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.semester')
            ->join('tb_tahun_ajaran', 'tb_kelas.id_tahun_ajaran = tb_tahun_ajaran.id', 'id')
            ->find($id_kelas);

        $data['mapel'] = $this->M_mata_pelajaran
            ->select('tb_mata_pelajaran.id as id_mapel, tb_mata_pelajaran.nama_mapel, tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.semester')
            ->join('tb_tahun_ajaran', 'tb_mata_pelajaran.id_tahun_ajaran = tb_tahun_ajaran.id', 'id')
            ->find($id_mapel);

        $data['nilai_siswa'] = $this->M_nilai_siswa
            ->select(
                'tb_nilai_siswa.id as id_nilai_siswa, tb_nilai_siswa.kkm, tb_nilai_siswa.nilai_hasil_pengetahuan_angka, tb_nilai_siswa.nilai_hasil_pengetahuan_huruf, tb_nilai_siswa.nilai_hasil_praktik_angka, tb_nilai_siswa.nilai_hasil_praktik_huruf, tb_nilai_siswa.sikap_efektif_predikat,
                tb_siswa.id as id_siswa, tb_siswa.nama_siswa'
            )
            ->join('tb_siswa', 'tb_nilai_siswa.id_siswa = tb_siswa.id', 'left')
            ->where('tb_nilai_siswa.id_kelas', $id_kelas)
            ->where('tb_nilai_siswa.id_mapel', $id_mapel)
            ->findAll();

        return view('nilai-siswa/V-edit-nilai-siswa', $data);
    }

    public function get_siswa($id_kelas, $id_mapel)
    {
        $data['kelas'] = $this->M_kelas
            ->select('tb_kelas.id as id_kelas, tb_kelas.nama_kelas, tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.semester')
            ->join('tb_tahun_ajaran', 'tb_kelas.id_tahun_ajaran = tb_tahun_ajaran.id', 'id')
            ->find($id_kelas);

        $data['mapel'] = $this->M_mata_pelajaran
            ->select('tb_mata_pelajaran.id as id_mapel, tb_mata_pelajaran.nama_mapel, tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.semester')
            ->join('tb_tahun_ajaran', 'tb_mata_pelajaran.id_tahun_ajaran = tb_tahun_ajaran.id', 'id')
            ->find($id_mapel);

        $data['nilai_siswa'] = $this->M_nilai_siswa
            ->select(
                'tb_nilai_siswa.id as id_nilai_siswa, tb_nilai_siswa.kkm, tb_nilai_siswa.nilai_hasil_pengetahuan_angka, tb_nilai_siswa.nilai_hasil_pengetahuan_huruf, tb_nilai_siswa.nilai_hasil_praktik_angka, tb_nilai_siswa.nilai_hasil_praktik_huruf, tb_nilai_siswa.sikap_efektif_predikat ,
                tb_siswa.id as id_siswa, tb_siswa.nama_siswa'
            )
            ->join('tb_siswa', 'tb_nilai_siswa.id_siswa = tb_siswa.id', 'left')
            ->where('tb_nilai_siswa.id_kelas', $id_kelas)
            ->where('tb_nilai_siswa.id_mapel', $id_mapel)
            ->findAll();

        if (empty($data['nilai_siswa'])) {
            $data['siswa'] = $this->M_siswa
                ->where('tb_siswa.id_kelas', $id_kelas)
                ->orderBy('tb_siswa.nama_siswa', 'asc')
                ->findAll();

            if (empty($data['siswa'])) {
                // Jika tidak ada siswa terdaftar di kelas ini
                $this->session->setFlashdata('error', 'Tidak ada siswa yang terdaftar pada kelas ini.');
                return redirect()->back(); // Kembali ke halaman sebelumnya
            }

            // 3. Masukkan data absensi baru untuk setiap siswa dengan status null
            foreach ($data['siswa'] as $siswa) {
                // Cek apakah siswa sudah ada absensinya pada tanggal tersebut
                $existingNilaiSiswa = $this->M_nilai_siswa
                    ->where('id_kelas', $id_kelas)
                    ->where('id_mapel', $id_mapel)
                    ->where('id_siswa', $siswa['id'])
                    ->first();  // Mengambil 1 data jika ada

                // Jika absensi tidak ada, insert ke tabel absensi
                if (!$existingNilaiSiswa) {
                    $this->M_nilai_siswa->insert([
                        'id_kelas' => $id_kelas,
                        'id_mapel' => $id_mapel,
                        'id_siswa' => $siswa['id'],
                    ]);
                }
            }
        }

        return redirect()->to('/nilai-siswa/edit/' . $id_kelas . '/' . $id_mapel);
    }

    public function update($id_kelas, $id_mapel)
    {
        // Ambil data nilai siswa yang ada
        $nilai_siswa = $this->M_nilai_siswa
            ->select('tb_nilai_siswa.id as id_nilai_siswa, tb_nilai_siswa.kkm, tb_nilai_siswa.nilai_hasil_pengetahuan_angka, tb_nilai_siswa.nilai_hasil_pengetahuan_huruf, tb_nilai_siswa.nilai_hasil_praktik_angka, tb_nilai_siswa.nilai_hasil_praktik_huruf, tb_nilai_siswa.sikap_efektif_predikat, 
                tb_siswa.id as id_siswa, tb_siswa.nama_siswa')
            ->join('tb_siswa', 'tb_nilai_siswa.id_siswa = tb_siswa.id', 'left')
            ->where('tb_nilai_siswa.id_kelas', $id_kelas)
            ->where('tb_nilai_siswa.id_mapel', $id_mapel)
            ->findAll();

        $errors = [];

        // Perbarui nilai untuk setiap siswa yang ada dalam $nilai_siswa
        foreach ($nilai_siswa as $siswa) {
            $id_siswa = $siswa['id_siswa']; // ID siswa

            // Ambil nilai yang diterima dari form untuk masing-masing siswa
            $kkm = $this->request->getPost("kkm_{$id_siswa}");
            $nilai_hasil_pengetahuan_angka = $this->request->getPost("nilai_hasil_pengetahuan_angka_{$id_siswa}");
            $nilai_hasil_pengetahuan_huruf = $this->request->getPost("nilai_hasil_pengetahuan_huruf_{$id_siswa}");
            $nilai_hasil_praktik_angka = $this->request->getPost("nilai_hasil_praktik_angka_{$id_siswa}");
            $nilai_hasil_praktik_huruf = $this->request->getPost("nilai_hasil_praktik_huruf_{$id_siswa}");
            $sikap_efektif_predikat = $this->request->getPost("sikap_efektif_predikat_{$id_siswa}");

            // Pastikan nilai yang diterima valid (misalnya tidak null)
            if (
                empty($kkm) || empty($nilai_hasil_pengetahuan_angka) || empty($nilai_hasil_pengetahuan_huruf) ||
                empty($nilai_hasil_praktik_angka) || empty($nilai_hasil_praktik_huruf) || empty($sikap_efektif_predikat)
            ) {
                $errors[] = "Data tidak lengkap untuk siswa {$siswa['nama_siswa']}";
                continue;  // Jika ada nilai yang kosong, lanjutkan ke siswa berikutnya
            }

            // Siapkan data untuk update
            $updateData = [
                'kkm' => $kkm,
                'nilai_hasil_pengetahuan_angka' => $nilai_hasil_pengetahuan_angka,
                'nilai_hasil_pengetahuan_huruf' => $nilai_hasil_pengetahuan_huruf,
                'nilai_hasil_praktik_angka' => $nilai_hasil_praktik_angka,
                'nilai_hasil_praktik_huruf' => $nilai_hasil_praktik_huruf,
                'sikap_efektif_predikat' => $sikap_efektif_predikat,
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            // Perbarui data nilai siswa di database
            $updateSuccess = $this->M_nilai_siswa->update($siswa['id_nilai_siswa'], $updateData);

            if (!$updateSuccess) {
                $errors[] = "Gagal memperbarui nilai untuk siswa {$siswa['nama_siswa']}";
            }
        }

        // Cek apakah ada error
        if (empty($errors)) {
            // Jika tidak ada error, simpan pesan sukses ke flashdata
            $this->session->setFlashdata('success', 'Nilai Siswa berhasil diperbarui.');
        } else {
            // Jika ada error, simpan pesan error dan data form untuk menghindari kehilangan input
            $this->session->setFlashdata('error', implode('<br>', $errors));

            // Menyimpan data yang telah diubah agar tidak hilang saat form diulang
            foreach ($nilai_siswa as $siswa) {
                $this->session->setFlashdata("kkm_{$siswa['id_siswa']}", $kkm);
                $this->session->setFlashdata("nilai_hasil_pengetahuan_angka_{$siswa['id_siswa']}", $nilai_hasil_pengetahuan_angka);
                $this->session->setFlashdata("nilai_hasil_pengetahuan_huruf_{$siswa['id_siswa']}", $nilai_hasil_pengetahuan_huruf);
                $this->session->setFlashdata("nilai_hasil_praktik_angka_{$siswa['id_siswa']}", $nilai_hasil_praktik_angka);
                $this->session->setFlashdata("nilai_hasil_praktik_huruf_{$siswa['id_siswa']}", $nilai_hasil_praktik_huruf);
                $this->session->setFlashdata("sikap_efektif_predikat_{$siswa['id_siswa']}", $sikap_efektif_predikat);
            }
        }

        return redirect()->back();
    }
}
