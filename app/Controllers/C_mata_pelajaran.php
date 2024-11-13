<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_mata_pelajaran;
use App\Models\M_tahun_ajaran;
use App\Models\M_pengguna;

class C_mata_pelajaran extends Controller
{
    protected $helpers = ['form'];
    protected $session;
    protected $M_mata_pelajaran;
    protected $M_tahun_ajaran;
    protected $M_pengguna;

    public function __construct()
    {
        $this->session          = session();
        $this->M_mata_pelajaran = new M_mata_pelajaran();
        $this->M_tahun_ajaran   = new M_tahun_ajaran();
        $this->M_pengguna       = new M_pengguna();
    }

    public function index()
    {
        $data['title']          = 'Daftar Data Mata Pelajaran';
        $data['mata_pelajaran'] = $this->M_mata_pelajaran
            ->select(
                'tb_mata_pelajaran.*,
                tb_tahun_ajaran.id as tahun_ajaran_id, tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.semester,
                tb_pengguna.id as guru_id, tb_pengguna.nama as nama_guru'
            )
            ->join('tb_tahun_ajaran', 'tb_mata_pelajaran.id_tahun_ajaran = tb_tahun_ajaran.id', 'left')
            ->join('tb_pengguna', 'tb_mata_pelajaran.id_guru = tb_pengguna.id', 'left')
            ->orderBy('tb_tahun_ajaran.tahun_ajaran', 'desc')
            ->orderBy('tb_tahun_ajaran.semester', 'desc')
            ->orderBy('tb_mata_pelajaran.nama_mapel', 'asc')
            ->orderBy('tb_pengguna.nama', 'asc')
            ->findAll();
        return view('mata-pelajaran/V-index-mata-pelajaran', $data);
    }

    public function create()
    {
        $data['title']        = 'Tambah Data Mata Pelajaran';
        $data['tahun_ajaran'] = $this->M_tahun_ajaran->orderBy('tahun_ajaran', 'desc')->orderBy('semester', 'desc')->findAll();
        $data['pengguna']     = $this->M_pengguna->orderBy('nama', 'asc')->findAll();
        return view('mata-pelajaran/V-create-mata-pelajaran', $data);
    }

    public function store()
    {
        $rules = [
            'id_tahun_ajaran' => 'required',
            'nama_mapel'      => 'required',
            'id_guru'         => 'required'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        try {
            // Cek apakah sudah ada data dengan id_tahun_ajaran dan nama_mapel yang sama
            $existingMapel = $this->M_mata_pelajaran->where([
                'id_tahun_ajaran' => $this->request->getPost('id_tahun_ajaran'),
                'nama_mapel'      => $this->request->getPost('nama_mapel')
            ])->first();

            // Jika sudah ada, beri pesan error
            if ($existingMapel) {
                $this->session->setFlashdata('error', 'Mata pelajaran untuk tahun ajaran ini sudah ada.');
                return redirect()->back()->withInput();
            }

            $this->M_mata_pelajaran->save([
                'id_tahun_ajaran' => $this->request->getPost('id_tahun_ajaran'),
                'nama_mapel'      => $this->request->getPost('nama_mapel'),
                'id_guru'         => $this->request->getPost('id_guru'),
            ]);

            $this->session->setFlashdata('success', 'Mata Pelajaran berhasil ditambahkan.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat menambahkan data.');
        }

        return redirect()->to('/mata-pelajaran');
    }

    public function edit($id)
    {
        $data['title']          = 'Ubah Data Mata Pelajaran';
        $data['tahun_ajaran'] = $this->M_tahun_ajaran->orderBy('tahun_ajaran', 'desc')->orderBy('semester', 'desc')->findAll();
        $data['pengguna']       = $this->M_pengguna->orderBy('nama', 'asc')->findAll();
        $data['mata_pelajaran'] = $this->M_mata_pelajaran->find($id);
        if (!$data['mata_pelajaran']) {
            $this->session->setFlashdata('error', 'Mata Pelajaran tidak ditemukan.');
            return redirect()->to('/mata-pelajaran');
        }

        return view('mata-pelajaran/V-edit-mata-pelajaran', $data);
    }

    public function update($id)
    {
        $rules = [
            'id_tahun_ajaran' => 'required',
            'nama_mapel'      => 'required',
            'id_guru'         => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $this->M_mata_pelajaran->update($id, [
                'id_tahun_ajaran' => $this->request->getPost('id_tahun_ajaran'),
                'nama_mapel'      => $this->request->getPost('nama_mapel'),
                'id_guru'         => $this->request->getPost('id_guru'),
            ]);

            $this->session->setFlashdata('success', 'Mata Pelajaran berhasil diperbarui.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->to('/mata-pelajaran');
    }

    public function delete($id)
    {
        try {
            $this->M_mata_pelajaran->delete($id);

            $this->session->setFlashdata('success', 'Mata Pelajaran berhasil dihapus.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->to('/mata-pelajaran');
    }
}
