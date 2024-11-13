<?php

namespace App\Models;

use CodeIgniter\Model;

class M_kepribadian extends Model
{
    protected $table = 'tb_kepribadian';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_rapor_siswa',
        'aspek_1',
        'keterangan_1',
        'aspek_2',
        'keterangan_2',
        'aspek_3',
        'keterangan_3',
        'aspek_4',
        'keterangan_4',
        'created_at',
        'updated_at',
    ];
}
