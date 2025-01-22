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

class C_rapor_saya extends Controller
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
        $data['title'] = 'Daftar Data Rapor Saya';

        $id_login = (session()->get('loggedUser')['id'] ?? 'ID');

        $builder = $this->M_rapor_siswa
            ->select(
                'tb_rapor_siswa.id as id_rapor_siswa,
                tb_kelas.id as id_kelas, tb_kelas.nama_kelas,
                tb_tahun_ajaran.id as id_tahun_ajaran, tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.semester,
                tb_siswa.id as id_siswa, tb_siswa.nama_siswa'
            )
            ->join('tb_kelas', 'tb_rapor_siswa.id_kelas = tb_kelas.id', 'left')
            ->join('tb_tahun_ajaran', 'tb_kelas.id_tahun_ajaran = tb_tahun_ajaran.id', 'left')
            ->join('tb_siswa', 'tb_rapor_siswa.id_siswa = tb_siswa.id', 'left');;
        $builder->where('tb_rapor_siswa.id_siswa', $id_login);
        $data['rapor_saya'] = $builder->findAll();

        return view('rapor-saya/V-index-rapor-saya', $data);
    }

    public function show($id_rapor_siswa)
    {
        $data['title'] = 'Ubah Data Rapor Saya';

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

        return view('rapor-saya/V-show-rapor-saya', $data);
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

        return view('rapor-saya/V-print-rapor-saya', $data);
    }
}
