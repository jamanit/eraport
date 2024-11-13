<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pengguna extends Model
{
    protected $table = 'tb_pengguna';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'email', 'password', 'id_peran', 'created_at', 'updated_at'];
}
