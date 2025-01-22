<?php

namespace App\Controllers;

use App\Models\M_pengguna;
use App\Models\M_siswa;

class C_auth extends BaseController
{
    public function register()
    {
        $title = 'Registrasi';

        if ($this->request->getMethod() === 'POST') {
            $model = new M_pengguna();

            // Ambil data dari input
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $confirmPassword = $this->request->getPost('confirm_password');

            // Cek apakah email sudah ada di database
            if ($model->where('email', $email)->first()) {
                return redirect()->back()->withInput()->with('error', 'Email sudah terdaftar. Silakan gunakan email lain.');
            }

            // Validasi password
            if (strlen($password) < 8) {
                return redirect()->back()->withInput()->with('error', 'Password minimal 8 karakter.');
            }

            if ($password !== $confirmPassword) {
                return redirect()->back()->withInput()->with('error', 'Konfirmasi password tidak cocok.');
            }

            // Siapkan data untuk disimpan
            $data = [
                'nama' => $this->request->getPost('nama'),
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'id_peran' => 1
            ];

            // Simpan data
            $model->save($data);
            return redirect()->to('/login')->with('success', 'Registrasi berhasil.');
        }
        return view('auth/register', ['title' => $title]);
    }

    // public function login()
    // {
    //     $title = 'Masuk';

    //     // Proses saat formulir login di-submit
    //     if ($this->request->getMethod() === 'POST') {
    //         // Ambil email dan password dari input form
    //         $email = $this->request->getPost('email');
    //         $password = $this->request->getPost('password');

    //         // Cek apakah email dan password valid
    //         $model = new M_pengguna();
    //         $user = $model->select('tb_pengguna.*, tb_peran.id as peran_id ,tb_peran.nama_peran')
    //             ->join('tb_peran', 'tb_pengguna.id_peran = tb_peran.id', 'left')
    //             ->where('email', $email)
    //             ->first();  // Cari pengguna berdasarkan email

    //         if ($user && password_verify($password, $user['password'])) {
    //             // Jika login berhasil, set data pengguna ke session
    //             session()->set('loggedUser', $user); // Menyimpan seluruh data pengguna dalam session
    //             return redirect()->to('/dashboard');
    //         }

    //         // Jika kredensial tidak valid, kembalikan pesan error
    //         return redirect()->back()->withInput()->with('error', 'Kredensial tidak valid');
    //     }

    //     // Jika bukan POST, tampilkan halaman login
    //     return view('auth/login', ['title' => $title]);
    // }

    public function login()
    {
        $title = 'Masuk';

        // Proses saat formulir login di-submit
        if ($this->request->getMethod() === 'POST') {
            // Ambil input dari form
            $identifier = $this->request->getPost('identifier'); // Email atau NISN
            $password = $this->request->getPost('password');

            // Cek apakah input berupa email atau NISN
            if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
                // Jika menggunakan email, cari di M_pengguna
                $model = new M_pengguna();
                $user = $model->select('tb_pengguna.*, tb_peran.id as peran_id ,tb_peran.nama_peran')
                    ->join('tb_peran', 'tb_pengguna.id_peran = tb_peran.id', 'left')
                    ->where('email', $identifier)
                    ->first();  // Cari pengguna berdasarkan email
            } else {
                // Jika menggunakan NISN, cari di M_siswa
                $model = new M_siswa();
                $user = $model->select('tb_siswa.id, tb_siswa.nisn, tb_siswa.password, tb_siswa.nama_siswa as nama, "Siswa" as nama_peran')
                    ->where('nisn', $identifier)->first();  // Cari siswa berdasarkan NISN
            }

            if ($user && password_verify($password, $user['password'])) {
                // Jika login berhasil, set data pengguna ke session
                session()->set('loggedUser', $user); // Menyimpan seluruh data pengguna dalam session
                return redirect()->to('/dashboard');
            }

            // Jika kredensial tidak valid, kembalikan pesan error
            return redirect()->back()->withInput()->with('error', 'Kredensial tidak valid');
        }

        // Jika bukan POST, tampilkan halaman login
        return view('auth/login', ['title' => $title]);
    }

    public function logout()
    {
        session()->destroy();
        session()->remove('loggedUser');
        return redirect()->to('/login')->with('success', 'Berhasil logout.');
    }
}
