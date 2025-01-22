<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_siswa;

class C_profil_saya extends Controller
{
    protected $helpers = ['form'];
    protected $session;
    protected $M_siswa;

    public function __construct()
    {
        $this->session = session();
        $this->M_siswa = new M_siswa();
    }

    public function index()
    {
        $id_login            = session()->get('loggedUser')['id'];
        $data['title']       = 'Data Profil Saya';
        $data['profil_saya'] = $this->M_siswa
            ->select('
                tb_siswa.*,
                tb_kelas.id as id_kelas, tb_kelas.nama_kelas,
                tb_tahun_ajaran.id as id_tahun_ajaran, tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.semester')
            ->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id', 'left')
            ->join('tb_tahun_ajaran', 'tb_kelas.id_tahun_ajaran = tb_tahun_ajaran.id', 'left')
            ->where('tb_siswa.id', $id_login)
            ->first();
        return view('profil-saya/V-index-profil-saya', $data);
    }

    public function update($id)
    {
        $rules = [
            'password'         => 'required|min_length[6]',
            'password_confirm' => 'matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $penggunaLama = $this->M_siswa->find($id);
            $password     = $this->request->getPost('password')
                ? password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
                :      $penggunaLama['password'];

            $this->M_siswa->update($id, [
                'password' => $password,
            ]);

            $this->session->setFlashdata('success', 'Profil berhasil diperbarui.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->to('/profil-saya');
    }
}
