<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_pengguna;
use App\Models\M_peran;

class C_profil extends Controller
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
        $id_pengguna    = session()->get('loggedUser')['id'];
        $data['title']  = 'Ubah Data Profil';
        $data['profil'] = $this->M_pengguna
            ->select('tb_pengguna.*, tb_peran.id as peran_id ,tb_peran.nama_peran')
            ->join('tb_peran', 'tb_pengguna.id_peran = tb_peran.id', 'left')
            ->where('tb_pengguna.id', $id_pengguna)
            ->first();
        return view('profil/V-index-profil', $data);
    }

    public function update($id)
    {
        $rules = [
            'nama'             => 'permit_empty',
            'password'         => 'permit_empty|min_length[6]',
            'password_confirm' => 'matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $penggunaLama = $this->M_pengguna->find($id);
            $nama         = $this->request->getPost('nama');
            $password     = $this->request->getPost('password')
                ? password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
                :      $penggunaLama['password'];

            $this->M_pengguna->update($id, [
                'nama'     => $nama,
                'password' => $password,
            ]);

            $this->session->setFlashdata('success', 'Profil berhasil diperbarui.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->to('/profil');
    }
}
