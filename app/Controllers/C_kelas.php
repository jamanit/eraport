<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_kelas;
use App\Models\M_tahun_ajaran;
use App\Models\M_pengguna;

class C_kelas extends Controller
{
    protected $helpers = ['form'];
    protected $session;
    protected $M_kelas;
    protected $M_tahun_ajaran;
    protected $M_pengguna;

    public function __construct()
    {
        $this->session        = session();
        $this->M_kelas        = new M_kelas();
        $this->M_tahun_ajaran = new M_tahun_ajaran();
        $this->M_pengguna     = new M_pengguna();
    }

    public function index()
    {
        $data['title'] = 'Daftar Data Kelas';
        $data['kelas'] = $this->M_kelas
            ->select(
                'tb_kelas.*,
                tb_tahun_ajaran.id as tahun_ajaran_id, tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.semester,
                tb_pengguna.id as guru_wali_id, tb_pengguna.nama as nama_guru_wali'
            )
            ->join('tb_tahun_ajaran', 'tb_kelas.id_tahun_ajaran = tb_tahun_ajaran.id', 'left')
            ->join('tb_pengguna', 'tb_kelas.id_guru_wali = tb_pengguna.id', 'left')
            ->orderBy('tb_tahun_ajaran.tahun_ajaran', 'desc')
            ->orderBy('tb_tahun_ajaran.semester', 'desc')
            ->orderBy('tb_kelas.nama_kelas', 'asc')
            ->orderBy('tb_pengguna.nama', 'asc')
            ->findAll();
        return view('kelas/V-index-kelas', $data);
    }

    public function create()
    {
        $data['title']        = 'Tambah Data Kelas';
        $data['tahun_ajaran'] = $this->M_tahun_ajaran->orderBy('tahun_ajaran', 'desc')->orderBy('semester', 'desc')->findAll();
        $data['pengguna']     = $this->M_pengguna->orderBy('nama', 'asc')->findAll();
        return view('kelas/V-create-kelas', $data);
    }

    public function store()
    {
        $rules = [
            'id_tahun_ajaran' => 'required',
            'nama_kelas'      => 'required',
            'id_guru_wali'    => 'required'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        try {
            // Cek apakah ada kelas dengan id_tahun_ajaran dan nama_kelas yang sama
            $existingKelas = $this->M_kelas->where([
                'id_tahun_ajaran' => $this->request->getPost('id_tahun_ajaran'),
                'nama_kelas'      => $this->request->getPost('nama_kelas')
            ])->first();

            // Jika sudah ada, beri pesan error
            if ($existingKelas) {
                $this->session->setFlashdata('error', 'Kelas dengan tahun ajaran dan nama kelas ini sudah ada.');
                return redirect()->back()->withInput();
            }

            $this->M_kelas->save([
                'id_tahun_ajaran' => $this->request->getPost('id_tahun_ajaran'),
                'nama_kelas'      => $this->request->getPost('nama_kelas'),
                'id_guru_wali'    => $this->request->getPost('id_guru_wali'),
            ]);

            $this->session->setFlashdata('success', 'Kelas berhasil ditambahkan.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat menambahkan data.');
        }

        return redirect()->to('/kelas');
    }

    public function edit($id)
    {
        $data['title']        = 'Ubah Data Kelas';
        $data['tahun_ajaran'] = $this->M_tahun_ajaran->orderBy('tahun_ajaran', 'desc')->orderBy('semester', 'desc')->findAll();
        $data['pengguna']     = $this->M_pengguna->orderBy('nama', 'asc')->findAll();
        $data['kelas']        = $this->M_kelas->find($id);
        if (!$data['kelas']) {
            $this->session->setFlashdata('error', 'Kelas tidak ditemukan.');
            return redirect()->to('/kelas');
        }

        return view('kelas/V-edit-kelas', $data);
    }

    public function update($id)
    {
        $rules = [
            'id_tahun_ajaran' => 'required',
            'nama_kelas'      => 'required',
            'id_guru_wali'    => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $this->M_kelas->update($id, [
                'id_tahun_ajaran' => $this->request->getPost('id_tahun_ajaran'),
                'nama_kelas'      => $this->request->getPost('nama_kelas'),
                'id_guru_wali'    => $this->request->getPost('id_guru_wali'),
            ]);

            $this->session->setFlashdata('success', 'Kelas berhasil diperbarui.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->to('/kelas');
    }

    public function delete($id)
    {
        try {
            $this->M_kelas->delete($id);

            $this->session->setFlashdata('success', 'Kelas berhasil dihapus.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->to('/kelas');
    }
}
