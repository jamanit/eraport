<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_pengguna;
use App\Models\M_peran;

class C_pengguna extends Controller
{
    protected $helpers = ['form'];
    protected $session;
    protected $M_pengguna;
    protected $M_peran;

    public function __construct()
    {
        $this->session    = session();
        $this->M_pengguna = new M_pengguna();
        $this->M_peran    = new M_peran();
    }

    public function index()
    {
        $data['title']    = 'Daftar Data Pengguna';
        $data['pengguna'] = $this->M_pengguna
            ->select('tb_pengguna.*, tb_peran.id as peran_id ,tb_peran.nama_peran')
            ->join('tb_peran', 'tb_pengguna.id_peran = tb_peran.id', 'left')
            ->orderBy('id', 'desc')
            ->findAll();
        return view('pengguna/V-index-pengguna', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Data Pengguna';
        $data['peran'] = $this->M_peran->orderBy('nama_peran', 'asc')->findAll();
        return view('pengguna/V-create-pengguna', $data);
    }

    public function store()
    {
        $rules = [
            'nama'             => 'required',
            'email'            => 'required|valid_email|is_unique[tb_pengguna.email]',
            'password'         => 'required|min_length[6]',
            'password_confirm' => 'matches[password]',
            'id_peran'         => 'required'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        try {
            $this->M_pengguna->save([
                'nama'     => $this->request->getPost('nama'),
                'email'    => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'id_peran' => $this->request->getPost('id_peran'),
            ]);

            $this->session->setFlashdata('success', 'Pengguna berhasil ditambahkan.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat menambahkan data.');
        }

        return redirect()->to('/pengguna');
    }

    public function edit($id)
    {
        $data['title']    = 'Ubah Data Pengguna';
        $data['peran'] = $this->M_peran->orderBy('nama_peran', 'asc')->findAll();
        $data['pengguna'] = $this->M_pengguna->find($id);
        if (!$data['pengguna']) {
            $this->session->setFlashdata('error', 'Pengguna tidak ditemukan.');
            return redirect()->to('/pengguna');
        }

        return view('pengguna/V-edit-pengguna', $data);
    }

    public function update($id)
    {
        $rules = [
            'nama'             => 'required',
            'email'            => 'required|valid_email',
            'password'         => 'permit_empty|min_length[6]',
            'password_confirm' => 'matches[password]',
            'id_peran'         => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $penggunaLama = $this->M_pengguna->find($id);

            $password = $this->request->getPost('password')
                ? password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
                :  $penggunaLama['password'];

            $this->M_pengguna->update($id, [
                'nama'     => $this->request->getPost('nama'),
                'email'    => $this->request->getPost('email'),
                'password' => $password,
                'id_peran' => $this->request->getPost('id_peran'),
            ]);

            $this->session->setFlashdata('success', 'Pengguna berhasil diperbarui.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->to('/pengguna');
    }

    public function delete($id)
    {
        try {
            $this->M_pengguna->delete($id);

            $this->session->setFlashdata('success', 'Pengguna berhasil dihapus.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->to('/pengguna');
    }
}
