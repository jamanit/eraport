<?php

namespace App\Models;

use CodeIgniter\Model;

class M_nilai_siswa extends Model
{
    protected $table = 'tb_nilai_siswa';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_kelas',
        'id_siswa',
        'id_mapel',
        'kkm',
        'nilai_hasil_pengetahuan_angka',
        'nilai_hasil_pengetahuan_huruf',
        'nilai_hasil_praktik_angka',
        'nilai_hasil_praktik_huruf',
        'sikap_efektif_predikat',
        'created_at',
        'updated_at',
    ];
}
