<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_wali_orang_tua;
use App\Models\M_siswa;

class C_wali_orang_tua extends Controller
{
    protected $helpers = ['form'];
    protected $session;
    protected $M_wali_orang_tua;
    protected $M_siswa;

    public function __construct()
    {
        $this->session          = session();
        $this->M_wali_orang_tua = new M_wali_orang_tua();
        $this->M_siswa          = new M_siswa();
    }

    public function index()
    {
        $data['title']          = 'Daftar Data Wali Orang Tua';
        $data['wali_orang_tua'] = $this->M_wali_orang_tua
            ->select('tb_wali_orang_tua.*, tb_siswa.id as siswa_id, tb_siswa.nisn, tb_siswa.nama_siswa')
            ->join('tb_siswa', 'tb_wali_orang_tua.id_siswa = tb_siswa.id', 'left')
            ->orderBy('tb_wali_orang_tua.id', 'desc')
            ->findAll();
        return view('wali-orang-tua/V-index-wali-orang-tua', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Data Wali Orang Tua';
        $data['siswa'] = $this->M_siswa->orderBy('nama_siswa', 'asc')->findAll();
        return view('wali-orang-tua/V-create-wali-orang-tua', $data);
    }

    public function store()
    {
        $rules = [
            'id_siswa'      => 'required',
            'nama_wali'     => 'required',
            'hubungan'      => 'required',
            'nomor_telepon' => 'required',
            'alamat'        => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        try {
            // Cek apakah id_siswa sudah ada
            $existingWali = $this->M_wali_orang_tua->where('id_siswa', $this->request->getPost('id_siswa'))->first();

            // Jika sudah ada, beri pesan error
            if ($existingWali) {
                $this->session->setFlashdata('error', 'Wali Orang Tua untuk siswa dengan ID tersebut sudah ada.');
                return redirect()->back()->withInput();
            }

            $this->M_wali_orang_tua->save([
                'id_siswa'      => $this->request->getPost('id_siswa'),
                'nama_wali'     => $this->request->getPost('nama_wali'),
                'hubungan'      => $this->request->getPost('hubungan'),
                'nomor_telepon' => $this->request->getPost('nomor_telepon'),
                'alamat'        => $this->request->getPost('alamat'),
            ]);

            $this->session->setFlashdata('success', 'Wali Orang Tua berhasil ditambahkan.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat menambahkan data.');
        }

        return redirect()->to('/wali-orang-tua');
    }

    public function edit($id)
    {
        $data['title']          = 'Ubah Data Wali Orang Tua';
        $data['siswa']          = $this->M_siswa->orderBy('nama_siswa', 'asc')->findAll();
        $data['wali_orang_tua'] = $this->M_wali_orang_tua->find($id);
        if (!$data['wali_orang_tua']) {
            $this->session->setFlashdata('error', 'Wali Orang Tua tidak ditemukan.');
            return redirect()->to('/wali-orang-tua');
        }

        return view('wali-orang-tua/V-edit-wali-orang-tua', $data);
    }

    public function update($id)
    {
        $rules = [
            'id_siswa'      => 'required',
            'nama_wali'     => 'required',
            'hubungan'      => 'required',
            'nomor_telepon' => 'required',
            'alamat'        => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $this->M_wali_orang_tua->update($id, [
                'id_siswa'      => $this->request->getPost('id_siswa'),
                'nama_wali'     => $this->request->getPost('nama_wali'),
                'hubungan'      => $this->request->getPost('hubungan'),
                'nomor_telepon' => $this->request->getPost('nomor_telepon'),
                'alamat'        => $this->request->getPost('alamat'),
            ]);

            $this->session->setFlashdata('success', 'Wali Orang Tua berhasil diperbarui.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->to('/wali-orang-tua');
    }

    public function delete($id)
    {
        try {
            $this->M_wali_orang_tua->delete($id);

            $this->session->setFlashdata('success', 'Wali Orang Tua berhasil dihapus.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->to('/wali-orang-tua');
    }
}
