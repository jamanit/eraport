<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_jadwal_pelajaran;
use App\Models\M_absensi;
use App\Models\M_siswa;

class C_absensi extends Controller
{
    protected $helpers = ['form'];
    protected $session;
    protected $M_jadwal_pelajaran;
    protected $M_absensi;
    protected $M_siswa;

    public function __construct()
    {
        $this->session          = session();
        $this->M_jadwal_pelajaran = new M_jadwal_pelajaran();
        $this->M_absensi        = new M_absensi();
        $this->M_siswa          = new M_siswa();
    }

    public function index()
    {
        $data['title'] = 'Daftar Data Absensi';

        $builder = $this->M_jadwal_pelajaran
            ->select(
                'tb_jadwal_pelajaran.id as id_jadwal_pelajaran, 
            tb_jadwal_pelajaran.hari, tb_jadwal_pelajaran.jam_ke,
            tb_kelas.id as id_kelas, tb_kelas.nama_kelas,
            tb_mata_pelajaran.id as id_mapel, tb_mata_pelajaran.nama_mapel,
            tb_tahun_ajaran.id as id_tahun_ajaran, tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.semester,
            tb_pengguna.id as id_guru, tb_pengguna.nama as nama_guru'
            )
            ->join('tb_kelas', 'tb_jadwal_pelajaran.id_kelas = tb_kelas.id', 'left')
            ->join('tb_mata_pelajaran', 'tb_jadwal_pelajaran.id_mapel = tb_mata_pelajaran.id', 'left')
            ->join('tb_tahun_ajaran', 'tb_kelas.id_tahun_ajaran = tb_tahun_ajaran.id', 'left')
            ->join('tb_pengguna', 'tb_mata_pelajaran.id_guru = tb_pengguna.id', 'left')
            ->orderBy('tb_tahun_ajaran.tahun_ajaran', 'desc')
            ->orderBy('tb_tahun_ajaran.semester', 'desc')
            ->orderBy('tb_kelas.nama_kelas', 'asc')
            ->orderBy('tb_mata_pelajaran.nama_mapel', 'asc')
            ->orderBy('tb_pengguna.nama', 'asc');

        // Jika id_login bukan '1', tambahkan kondisi where untuk membatasi berdasarkan id_guru
        $id_login = (session()->get('loggedUser')['id'] ?? 'ID');
        if ($id_login != '1') {
            $builder->where('tb_pengguna.id', $id_login);
        }

        // Ambil hasil query
        $data['jadwal_pelajaran'] = $builder->findAll();

        return view('absensi/V-index-absensi', $data);
    }

    public function edit($id_jadwal_pelajaran, $tanggal = null)
    {
        $data['title'] = 'Ubah Data Absensi';
        $data['jadwal_pelajaran'] = $this->M_jadwal_pelajaran
            ->select(
                '
            tb_jadwal_pelajaran.id as id_jadwal_pelajaran, tb_jadwal_pelajaran.hari, tb_jadwal_pelajaran.jam_ke,
            tb_kelas.id as id_kelas, tb_kelas.nama_kelas,
            tb_mata_pelajaran.id as id_mapel, tb_mata_pelajaran.nama_mapel,
            tb_tahun_ajaran.id as id_tahun_ajaran, tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.semester,
            tb_pengguna.id as id_guru, tb_pengguna.nama as nama_guru'
            )
            ->join('tb_kelas', 'tb_jadwal_pelajaran.id_kelas = tb_kelas.id', 'left')
            ->join('tb_mata_pelajaran', 'tb_jadwal_pelajaran.id_mapel = tb_mata_pelajaran.id', 'left')
            ->join('tb_tahun_ajaran', 'tb_kelas.id_tahun_ajaran = tb_tahun_ajaran.id', 'left')
            ->join('tb_pengguna', 'tb_mata_pelajaran.id_guru = tb_pengguna.id', 'left')
            ->find($id_jadwal_pelajaran);

        $data['tanggal'] = $tanggal ?? date('Y-m-d');
        $data['absensi'] = $this->M_absensi
            ->select('tb_absensi.*, tb_siswa.nama_siswa')
            ->join('tb_siswa', 'tb_absensi.id_siswa = tb_siswa.id', 'left')
            ->where('tb_absensi.id_jadwal_pelajaran', $id_jadwal_pelajaran)
            ->where('tb_absensi.tanggal', $tanggal)
            ->orderBy('tb_siswa.nama_siswa', 'asc')
            ->findAll();

        return view('absensi/V-edit-absensi', $data);
    }

    public function get_siswa($id_jadwal_pelajaran)
    {
        $data['title'] = 'Ubah Data Absensi';
        $data['jadwal_pelajaran'] = $this->M_jadwal_pelajaran
            ->select(
                '
            tb_jadwal_pelajaran.id, tb_jadwal_pelajaran.hari, tb_jadwal_pelajaran.jam_ke,
            tb_kelas.id as id_kelas, tb_kelas.nama_kelas,
            tb_mata_pelajaran.id as id_mapel, tb_mata_pelajaran.nama_mapel,
            tb_tahun_ajaran.id as id_tahun_ajaran, tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.semester,
            tb_pengguna.id as id_guru, tb_pengguna.nama as nama_guru'
            )
            ->join('tb_kelas', 'tb_jadwal_pelajaran.id_kelas = tb_kelas.id', 'left')
            ->join('tb_mata_pelajaran', 'tb_jadwal_pelajaran.id_mapel = tb_mata_pelajaran.id', 'left')
            ->join('tb_tahun_ajaran', 'tb_kelas.id_tahun_ajaran = tb_tahun_ajaran.id', 'left')
            ->join('tb_pengguna', 'tb_mata_pelajaran.id_guru = tb_pengguna.id', 'left')
            ->find($id_jadwal_pelajaran);

        // Ambil tanggal dari input form
        $tanggal = $this->request->getPost('tanggal');

        // 1. Ambil siswa yang sudah ada di absensi berdasarkan tanggal dan jadwal pelajaran
        $data['siswa'] = $this->M_siswa
            ->join('tb_absensi', 'tb_absensi.id_siswa = tb_siswa.id')
            ->where('tb_absensi.id_jadwal_pelajaran', $id_jadwal_pelajaran)
            ->where('tb_absensi.tanggal', $tanggal)
            ->orderBy('tb_siswa.nama_siswa', 'asc')
            ->findAll();

        // 2. Jika data absensi tidak ditemukan (kosong), ambil semua siswa di jadwal pelajaran tersebut
        if (empty($data['siswa'])) {
            // Ambil semua siswa di jadwal pelajaran tersebut
            $data['siswa'] = $this->M_siswa
                ->where('tb_siswa.id_kelas', $data['jadwal_pelajaran']['id_kelas'])
                ->findAll();

            if (empty($data['siswa'])) {
                // Jika tidak ada siswa terdaftar di kelas ini
                $this->session->setFlashdata('error', 'Tidak ada siswa yang terdaftar pada kelas ini.');
                return redirect()->back(); // Kembali ke halaman sebelumnya
            }

            // 3. Masukkan data absensi baru untuk setiap siswa dengan status null
            foreach ($data['siswa'] as $siswa) {
                // Cek apakah siswa sudah ada absensinya pada tanggal tersebut
                $existingAbsensi = $this->M_absensi
                    ->where('id_siswa', $siswa['id'])
                    ->where('id_jadwal_pelajaran', $id_jadwal_pelajaran)
                    ->where('tanggal', $tanggal)
                    ->first();  // Mengambil 1 data jika ada

                // Jika absensi tidak ada, insert ke tabel absensi
                if (!$existingAbsensi) {
                    $this->M_absensi->insert([
                        'id_jadwal_pelajaran' => $id_jadwal_pelajaran,
                        'id_siswa' => $siswa['id'],
                        'tanggal'  => $tanggal,
                    ]);
                }
            }
        }

        return redirect()->to('/absensi/edit/' . $id_jadwal_pelajaran . '/' . $tanggal);
    }

    public function update($id_jadwal_pelajaran, $tanggal = null)
    {
        $absensi = $this->M_absensi
            ->select('tb_absensi.*, tb_siswa.nama_siswa')
            ->join('tb_siswa', 'tb_absensi.id_siswa = tb_siswa.id', 'left')
            ->where('tb_absensi.id_jadwal_pelajaran', $id_jadwal_pelajaran)
            ->where('tb_absensi.tanggal', $tanggal)
            ->findAll();

        // Update status dan keterangan untuk setiap siswa
        $errors = [];
        foreach ($absensi as $item) {
            $id_siswa   = $item['id_siswa'];
            $status     = $this->request->getPost("status_{$id_siswa}");
            $keterangan = $this->request->getPost("keterangan_{$id_siswa}");

            if ($status && in_array($status, ['Hadir', 'Tidak Hadir', 'Izin', 'Sakit'])) {
                // Perbarui status dan keterangan absensi
                $updateData = [
                    'status'     => $status,
                    'keterangan' => $keterangan,
                    'updated_at' => date('Y-m-d H:i:s'),
                ];

                // Update ke database
                if (!$this->M_absensi->update($item['id'], $updateData)) {
                    $errors[] = "Gagal memperbarui absensi untuk siswa {$item['nama_siswa']}";
                }
            } else {
                $errors[] = "Status tidak valid untuk siswa {$item['nama_siswa']}";
            }
        }

        // Cek apakah ada error
        if (empty($errors)) {
            // Jika tidak ada error, simpan pesan sukses ke flashdata
            $this->session->setFlashdata('success', 'Absensi berhasil diperbarui.');
        } else {
            // Jika ada error, simpan pesan error dan data form untuk menghindari kehilangan input
            $this->session->setFlashdata('error', implode('<br>', $errors));
            // Menyimpan data status dan keterangan yang telah diubah agar tidak hilang saat form diulang
            foreach ($absensi as $item) {
                $status     = $this->request->getPost("status_{$item['id_siswa']}");
                $keterangan = $this->request->getPost("keterangan_{$item['id_siswa']}");
                $this->session->setFlashdata("status_{$item['id_siswa']}", $status);
                $this->session->setFlashdata("keterangan_{$item['id_siswa']}", $keterangan);
            }
        }

        return redirect()->back();
    }
}
