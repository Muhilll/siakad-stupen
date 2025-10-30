<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelasMapel extends Model
{
    protected $fillable = [
        'kelas_id',
        'mapel_guru_id',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function mapelGuru()
    {
        return $this->belongsTo(MapelGuru::class, 'mapel_guru_id');
    }

    public function materi()
    {
        return $this->hasMany(Materi::class, 'kelas_mapel_id');
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'kelas_mapel_id');
    }
}
