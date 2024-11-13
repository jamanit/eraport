<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_tahun_ajaran;

class C_tahun_ajaran extends Controller
{
    protected $helpers = ['form'];
    protected $session;
    protected $M_tahun_ajaran;

    public function __construct()
    {
        $this->session        = session();
        $this->M_tahun_ajaran = new M_tahun_ajaran();
    }

    public function index()
    {
        $data['title']        = 'Daftar Data Peran';
        $data['tahun_ajaran'] = $this->M_tahun_ajaran
            ->orderBy('tb_tahun_ajaran.tahun_ajaran', 'desc')
            ->orderBy('tb_tahun_ajaran.semester', 'desc')
            ->findAll();
        return view('tahun-ajaran/V-index-tahun-ajaran', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Data Peran';
        return view('tahun-ajaran/V-create-tahun-ajaran', $data);
    }

    public function store()
    {
        $rules = [
            'tahun_ajaran' => 'required',
            'semester'     => 'required',
            'mulai'        => 'required',
            'selesai'      => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        try {
            // Cek apakah ada tahun ajaran dan semester yang sama
            $existingTahunAjaran = $this->M_tahun_ajaran->where([
                'tahun_ajaran' => $this->request->getPost('tahun_ajaran'),
                'semester'     => $this->request->getPost('semester')
            ])->first();

            // Jika sudah ada, beri pesan error
            if ($existingTahunAjaran) {
                $this->session->setFlashdata('error', 'Tahun ajaran dan semester ini sudah ada.');
                return redirect()->back()->withInput();
            }

            $this->M_tahun_ajaran->save([
                'tahun_ajaran' => $this->request->getPost('tahun_ajaran'),
                'semester'     => $this->request->getPost('semester'),
                'mulai'        => $this->request->getPost('mulai'),
                'selesai'      => $this->request->getPost('selesai'),
            ]);

            $this->session->setFlashdata('success', 'Peran berhasil ditambahkan.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat menambahkan data.');
        }

        return redirect()->to('/tahun-ajaran');
    }

    public function edit($id)
    {
        $data['title']        = 'Ubah Data Peran';
        $data['tahun_ajaran'] = $this->M_tahun_ajaran->find($id);
        if (!$data['tahun_ajaran']) {
            $this->session->setFlashdata('error', 'Peran tidak ditemukan.');
            return redirect()->to('/tahun-ajaran');
        }

        return view('tahun-ajaran/V-edit-tahun-ajaran', $data);
    }

    public function update($id)
    {
        $rules = [
            'tahun_ajaran' => 'required',
            'semester'     => 'required',
            'mulai'        => 'required',
            'selesai'      => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $this->M_tahun_ajaran->update($id, [
                'tahun_ajaran' => $this->request->getPost('tahun_ajaran'),
                'semester'     => $this->request->getPost('semester'),
                'mulai'        => $this->request->getPost('mulai'),
                'selesai'      => $this->request->getPost('selesai'),
            ]);

            $this->session->setFlashdata('success', 'Peran berhasil diperbarui.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->to('/tahun-ajaran');
    }

    public function delete($id)
    {
        try {
            $this->M_tahun_ajaran->delete($id);

            $this->session->setFlashdata('success', 'Peran berhasil dihapus.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->to('/tahun-ajaran');
    }
}
