<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_jadwal_pelajaran;
use App\Models\M_tahun_ajaran;
use App\Models\M_kelas;
use App\Models\M_mata_pelajaran;

class C_jadwal_pelajaran extends Controller
{
    protected $helpers = ['form'];
    protected $session;
    protected $M_jadwal_pelajaran;
    protected $M_tahun_ajaran;
    protected $M_kelas;
    protected $M_mata_pelajaran;

    public function __construct()
    {
        $this->session            = session();
        $this->M_jadwal_pelajaran = new M_jadwal_pelajaran();
        $this->M_tahun_ajaran     = new M_tahun_ajaran();
        $this->M_kelas            = new M_kelas();
        $this->M_mata_pelajaran   = new M_mata_pelajaran();
    }

    public function index()
    {
        $data['title']            = 'Daftar Data Jadwal Pelajaran';
        $data['jadwal_pelajaran'] = $this->M_jadwal_pelajaran
            ->select(
                'tb_jadwal_pelajaran.id, tb_jadwal_pelajaran.hari, tb_jadwal_pelajaran.jam_ke,
                tb_kelas.id as id_mapel, tb_kelas.nama_kelas,
                tb_mata_pelajaran.id as id_mapel, tb_mata_pelajaran.nama_mapel,
                tb_tahun_ajaran.id as id_tahun_ajaran, tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.semester'
            )
            ->join('tb_kelas', 'tb_jadwal_pelajaran.id_kelas = tb_kelas.id', 'left')
            ->join('tb_mata_pelajaran', 'tb_jadwal_pelajaran.id_mapel = tb_mata_pelajaran.id', 'left')
            ->join('tb_tahun_ajaran', 'tb_kelas.id_tahun_ajaran = tb_tahun_ajaran.id', 'left')
            ->orderBy('tb_tahun_ajaran.tahun_ajaran', 'desc')
            ->orderBy('tb_tahun_ajaran.semester', 'desc')
            ->orderBy('tb_kelas.nama_kelas', 'asc')
            ->orderBy('tb_mata_pelajaran.nama_mapel', 'asc')
            ->findAll();
        return view('jadwal-pelajaran/V-index-jadwal-pelajaran', $data);
    }

    public function create()
    {
        $data['title']        = 'Tambah Data Jadwal Pelajaran';
        $data['tahun_ajaran'] = $this->M_tahun_ajaran->orderBy('tahun_ajaran', 'desc')->orderBy('semester', 'desc')->findAll();
        $data['kelas']        = $this->M_kelas
            ->select('tb_kelas.id, tb_kelas.nama_kelas, tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.semester')
            ->join('tb_tahun_ajaran', 'tb_kelas.id_tahun_ajaran = tb_tahun_ajaran.id', 'left')
            ->orderBy('tb_tahun_ajaran.tahun_ajaran', 'desc')
            ->orderBy('tb_tahun_ajaran.semester', 'desc')
            ->orderBy('tb_kelas.nama_kelas', 'asc')
            ->findAll();
        $data['mapel'] = $this->M_mata_pelajaran
            ->select('tb_mata_pelajaran.id, tb_mata_pelajaran.nama_mapel, tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.semester')
            ->join('tb_tahun_ajaran', 'tb_mata_pelajaran.id_tahun_ajaran = tb_tahun_ajaran.id', 'left')
            ->orderBy('tb_tahun_ajaran.tahun_ajaran', 'desc')
            ->orderBy('tb_tahun_ajaran.semester', 'desc')
            ->orderBy('tb_mata_pelajaran.nama_mapel', 'asc')
            ->findAll();
        return view('jadwal-pelajaran/V-create-jadwal-pelajaran', $data);
    }

    public function store()
    {
        $rules = [
            'id_kelas' => 'required',
            'id_mapel' => 'required',
            'hari'     => 'required',
            'jam_ke'   => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        try {
            // Cek apakah sudah ada jadwal pelajaran dengan id_kelas dan id_mapel yang sama
            $existingJadwal = $this->M_jadwal_pelajaran->where([
                'id_kelas' => $this->request->getPost('id_kelas'),
                'id_mapel' => $this->request->getPost('id_mapel')
            ])->first();

            // Jika sudah ada, beri pesan error
            if ($existingJadwal) {
                $this->session->setFlashdata('error', 'Jadwal pelajaran untuk kelas dan mata pelajaran ini sudah ada.');
                return redirect()->back()->withInput();
            }

            $this->M_jadwal_pelajaran->save([
                'id_kelas' => $this->request->getPost('id_kelas'),
                'id_mapel' => $this->request->getPost('id_mapel'),
                'hari'     => $this->request->getPost('hari'),
                'jam_ke'   => $this->request->getPost('jam_ke'),
            ]);

            $this->session->setFlashdata('success', 'Jadwal Pelajaran berhasil ditambahkan.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat menambahkan data.');
        }

        return redirect()->to('/jadwal-pelajaran');
    }

    public function edit($id)
    {
        $data['title']          = 'Ubah Data Jadwal Pelajaran';
        $data['tahun_ajaran']   = $this->M_tahun_ajaran->orderBy('tahun_ajaran', 'desc')->orderBy('semester', 'desc')->findAll();
        $data['kelas']        = $this->M_kelas
            ->select('tb_kelas.id, tb_kelas.nama_kelas, tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.semester')
            ->join('tb_tahun_ajaran', 'tb_kelas.id_tahun_ajaran = tb_tahun_ajaran.id', 'left')
            ->orderBy('tb_tahun_ajaran.tahun_ajaran', 'desc')
            ->orderBy('tb_tahun_ajaran.semester', 'desc')
            ->orderBy('tb_kelas.nama_kelas', 'asc')
            ->findAll();
        $data['mapel'] = $this->M_mata_pelajaran
            ->select('tb_mata_pelajaran.id, tb_mata_pelajaran.nama_mapel, tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.semester')
            ->join('tb_tahun_ajaran', 'tb_mata_pelajaran.id_tahun_ajaran = tb_tahun_ajaran.id', 'left')
            ->orderBy('tb_tahun_ajaran.tahun_ajaran', 'desc')
            ->orderBy('tb_tahun_ajaran.semester', 'desc')
            ->orderBy('tb_mata_pelajaran.nama_mapel', 'asc')
            ->findAll();
        $data['jadwal_pelajaran'] = $this->M_jadwal_pelajaran->find($id);
        if (!$data['jadwal_pelajaran']) {
            $this->session->setFlashdata('error', 'Jadwal Pelajaran tidak ditemukan.');
            return redirect()->to('/jadwal-pelajaran');
        }

        return view('jadwal-pelajaran/V-edit-jadwal-pelajaran', $data);
    }

    public function update($id)
    {
        $rules = [
            'id_kelas' => 'required',
            'id_mapel' => 'required',
            'hari'     => 'required',
            'jam_ke'   => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $this->M_jadwal_pelajaran->update($id, [
                'id_kelas' => $this->request->getPost('id_kelas'),
                'id_mapel' => $this->request->getPost('id_mapel'),
                'hari'     => $this->request->getPost('hari'),
                'jam_ke'   => $this->request->getPost('jam_ke'),
            ]);

            $this->session->setFlashdata('success', 'Jadwal Pelajaran berhasil diperbarui.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->to('/jadwal-pelajaran');
    }

    public function delete($id)
    {
        try {
            $this->M_jadwal_pelajaran->delete($id);

            $this->session->setFlashdata('success', 'Jadwal Pelajaran berhasil dihapus.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->to('/jadwal-pelajaran');
    }
}
