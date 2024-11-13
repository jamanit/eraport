<?php

namespace App\Models;

use CodeIgniter\Model;

class M_mata_pelajaran extends Model
{
    protected $table = 'tb_mata_pelajaran';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_tahun_ajaran', 'nama_mapel', 'id_guru', 'created_at', 'updated_at'];
}
