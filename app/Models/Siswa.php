<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = [
        'nis',
        'nisn',
        'nama',
        'jkl',
        'tmp_lahir',
        'tgl_lahir',
        'agama',
        'alamat',
        'no_hp',
        'tahun_masuk',
        'status',
        'nama_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'nohp_ortu',
    ];

    public function anggotaKelas()
    {
        return $this->hasMany(AgtKelas::class);
    }
}
