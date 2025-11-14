<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $fillable = [
        'jenis_ptk',
        'nama_lengkap',
        'nip',
        'pangkat',
        'golongan',
        'tmt',
        'mkg_cpns_tahun',
        'mkg_cpns_bulan',
        'mkg_total_tahun',
        'mkg_total_bulan',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'nik',
        'nuptk',
        'no_hp',
        'email',
        'jabatan',
        'sertifikasi_bidang_studi',
        'sertifikasi_tahun',
        'pendidikan_jenjang',
        'pendidikan_gelar',
        'pendidikan_bidang_studi',
        'pendidikan_tahun',
    ];


    public function mapelGuru()
    {
        return $this->hasMany(MapelGuru::class);
    }
}
