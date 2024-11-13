<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_siswa;
use App\Models\M_kelas;

class C_siswa extends Controller
{
    protected $helpers = ['form'];
    protected $session;
    protected $M_siswa;
    protected $M_kelas;
    protected $M_tahun_ajaran;

    public function __construct()
    {
        $this->session = session();
        $this->M_siswa = new M_siswa();
        $this->M_kelas = new M_kelas();
    }

    public function index()
    {
        $data['title'] = 'Daftar Data Siswa';
        $data['siswa'] = $this->M_siswa
            ->select(
                '
            tb_siswa.*, 
            tb_kelas.id as kelas_id, 
            tb_kelas.nama_kelas, 
            tb_tahun_ajaran.tahun_ajaran, 
            tb_tahun_ajaran.semester'
            )
            ->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id', 'left')
            ->join('tb_tahun_ajaran', 'tb_kelas.id_tahun_ajaran = tb_tahun_ajaran.id', 'left')
            ->orderBy('tb_siswa.id', 'desc')
            ->findAll();

        return view('siswa/V-index-siswa', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Data Siswa';
        $data['kelas'] = $this->M_kelas
            ->select(
                'tb_kelas.*,
                tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.semester'
            )
            ->join('tb_tahun_ajaran', 'tb_kelas.id_tahun_ajaran = tb_tahun_ajaran.id', 'left')
            ->orderBy('tb_tahun_ajaran.tahun_ajaran', 'desc')
            ->orderBy('tb_tahun_ajaran.semester', 'desc')
            ->orderBy('tb_kelas.nama_kelas', 'asc')
            ->findAll();
        return view('siswa/V-create-siswa', $data);
    }

    public function store()
    {
        $rules = [
            'nisn'          => 'required|is_unique[tb_siswa.nisn]',
            'nama_siswa'    => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'alamat'        => 'required',
            'nomor_telepon' => 'required',
            'id_kelas'      => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        try {
            $this->M_siswa->save([
                'nisn'          => $this->request->getPost('nisn'),
                'nama_siswa'    => $this->request->getPost('nama_siswa'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'alamat'        => $this->request->getPost('alamat'),
                'nomor_telepon' => $this->request->getPost('nomor_telepon'),
                'id_kelas'      => $this->request->getPost('id_kelas'),
            ]);

            $this->session->setFlashdata('success', 'Siswa berhasil ditambahkan.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat menambahkan data.');
        }

        return redirect()->to('/siswa');
    }

    public function edit($id)
    {
        $data['title'] = 'Ubah Data Siswa';
        $data['kelas'] = $this->M_kelas
            ->select(
                'tb_kelas.*,
            tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.semester'
            )
            ->join('tb_tahun_ajaran', 'tb_kelas.id_tahun_ajaran = tb_tahun_ajaran.id', 'left')
            ->orderBy('tb_tahun_ajaran.tahun_ajaran', 'desc')
            ->orderBy('tb_tahun_ajaran.semester', 'desc')
            ->orderBy('tb_kelas.nama_kelas', 'asc')
            ->findAll();
        $data['siswa'] = $this->M_siswa->find($id);
        if (!$data['siswa']) {
            $this->session->setFlashdata('error', 'Siswa tidak ditemukan.');
            return redirect()->to('/siswa');
        }

        return view('siswa/V-edit-siswa', $data);
    }

    public function update($id)
    {
        $rules = [
            'nisn'          => 'required|is_unique[tb_siswa.nisn,id,' . $id . ']',
            'nama_siswa'    => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'alamat'        => 'required',
            'nomor_telepon' => 'required',
            'id_kelas'      => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $this->M_siswa->update($id, [
                'nisn'          => $this->request->getPost('nisn'),
                'nama_siswa'    => $this->request->getPost('nama_siswa'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'alamat'        => $this->request->getPost('alamat'),
                'nomor_telepon' => $this->request->getPost('nomor_telepon'),
                'id_kelas'      => $this->request->getPost('id_kelas'),
            ]);

            $this->session->setFlashdata('success', 'Siswa berhasil diperbarui.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->to('/siswa');
    }

    public function delete($id)
    {
        try {
            $this->M_siswa->delete($id);

            $this->session->setFlashdata('success', 'Siswa berhasil dihapus.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->to('/siswa');
    }
}
