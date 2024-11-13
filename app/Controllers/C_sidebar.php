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
}
