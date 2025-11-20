<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgtKelas extends Model
{
    protected $fillable = [
        'siswa_id',
        'kelas_id',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function pengumpulan()
    {
        return $this->hasMany(Pengumpulan::class, 'agt_kelas_id');
    }

    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'agt_kelas_id');
    }
}
