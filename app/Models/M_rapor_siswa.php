<?php

namespace App\Models;

use CodeIgniter\Model;

class M_rapor_siswa extends Model
{
    protected $table = 'tb_rapor_siswa';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_siswa',
        'id_kelas',
        'hasil_keputusan',
        'catatan',
        'created_at',
        'updated_at',
    ];
}
