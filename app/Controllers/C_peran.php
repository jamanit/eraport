<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_peran;

class C_peran extends Controller
{
    protected $helpers = ['form'];
    protected $session;
    protected $M_peran;

    public function __construct()
    {
        $this->session = session();
        $this->M_peran = new M_peran();
    }

    public function index()
    {
        $data['title'] = 'Daftar Data Peran';
        $data['peran'] = $this->M_peran->orderBy('id', 'desc')->findAll();
        return view('peran/V-index-peran', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Data Peran';
        return view('peran/V-create-peran', $data);
    }

    public function store()
    {
        $rules = [
            'nama_peran' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        try {
            $this->M_peran->save([
                'nama_peran' => $this->request->getPost('nama_peran'),
            ]);

            $this->session->setFlashdata('success', 'Peran berhasil ditambahkan.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat menambahkan data.');
        }

        return redirect()->to('/peran');
    }

    public function edit($id)
    {
        $data['title'] = 'Ubah Data Peran';
        $data['peran'] = $this->M_peran->find($id);
        if (!$data['peran']) {
            $this->session->setFlashdata('error', 'Peran tidak ditemukan.');
            return redirect()->to('/peran');
        }

        return view('peran/V-edit-peran', $data);
    }

    public function update($id)
    {
        $rules = [
            'nama_peran' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $this->M_peran->update($id, [
                'nama_peran' => $this->request->getPost('nama_peran'),
            ]);

            $this->session->setFlashdata('success', 'Peran berhasil diperbarui.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->to('/peran');
    }

    public function delete($id)
    {
        try {
            $this->M_peran->delete($id);

            $this->session->setFlashdata('success', 'Peran berhasil dihapus.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->to('/peran');
    }
}
