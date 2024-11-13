<?php

namespace App\Models;

use CodeIgniter\Model;

class M_catatan extends Model
{
    protected $table         = 'tb_catatan';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'id_siswa',
        'id_kelas',
        'catatan',
        'created_at',
        'updated_at',
    ];
}
