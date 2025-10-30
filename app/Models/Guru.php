<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $fillable = [
        'nip',
        'nuptk',
        'nama_lengkap',
        'jenis_kelamin',
        'tmp_lahir',
        'tgl_lahir',
        'agama',
        'alamat',
        'no_hp',
        'email',
        'status_pegawai',
        'jabatan',
        'sertifikasi',
        'status_mengajar',
    ];

    public function mapelGuru()
    {
        return $this->hasMany(MapelGuru::class);
    }
}
