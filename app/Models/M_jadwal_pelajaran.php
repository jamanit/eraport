<?php

namespace App\Models;

use CodeIgniter\Model;

class M_jadwal_pelajaran extends Model
{
    protected $table = 'tb_jadwal_pelajaran';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_kelas',
        'id_mapel',
        'hari',
        'jam_ke',
        'created_at',
        'updated_at',
    ];
}
