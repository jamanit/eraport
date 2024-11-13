<?php

namespace App\Models;

use CodeIgniter\Model;

class M_siswa extends Model
{
    protected $table = 'tb_siswa';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nisn',
        'nama_siswa',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'nomor_telepon',
        'id_kelas',
        'id_tahun_ajaran',
        'created_at',
        'updated_at'
    ];
}
