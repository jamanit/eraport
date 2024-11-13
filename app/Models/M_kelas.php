<?php

namespace App\Models;

use CodeIgniter\Model;

class M_kelas extends Model
{
    protected $table = 'tb_kelas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_tahun_ajaran', 'nama_kelas', 'id_guru_wali', 'created_at', 'updated_at'];
}
