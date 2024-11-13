<?php

namespace App\Models;

use CodeIgniter\Model;

class M_wali_orang_tua extends Model
{
    protected $table = 'tb_wali_orang_tua';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_siswa',
        'nama_wali',
        'hubungan',
        'nomor_telepon',
        'alamat',
        'created_at',
        'updated_at'
    ];
}
