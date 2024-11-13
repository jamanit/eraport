<?php

namespace App\Models;

use CodeIgniter\Model;

class M_tahun_ajaran extends Model
{
    protected $table = 'tb_tahun_ajaran';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tahun_ajaran', 'semester', 'mulai', 'selesai', 'created_at', 'updated_at'];
}
