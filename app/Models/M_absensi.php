<?php

namespace App\Models;

use CodeIgniter\Model;

class M_absensi extends Model
{
    protected $table = 'tb_absensi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_jadwal_pelajaran', 'id_siswa', 'tanggal', 'status', 'keterangan', 'created_at', 'updated_at'];
}
