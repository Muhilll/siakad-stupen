<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $fillable = [
        'nama',
        'batas',
        'kelas_mapel_id',
    ];

    public function kelasMapel()
    {
        return $this->belongsTo(KelasMapel::class, 'kelas_mapel_id');
    }

    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'absensi_id');
    }
}
