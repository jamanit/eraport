<?php

namespace App\Models;

use CodeIgniter\Model;

class M_peran extends Model
{
    protected $table = 'tb_peran';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_peran', 'created_at', 'updated_at'];
}
