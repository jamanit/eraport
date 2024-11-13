<?php

namespace App\Models;

use CodeIgniter\Model;

class M_ekstra_kurikuler extends Model
{
    protected $table = 'tb_ekstra_kurikuler';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_rapor_siswa',
        'jenis_kegiatan_1',
        'nilai_1',
        'jenis_kegiatan_2',
        'nilai_2',
        'jenis_kegiatan_3',
        'nilai_3',
        'jenis_kegiatan_4',
        'nilai_4',
        'created_at',
        'updated_at',
    ];
}
