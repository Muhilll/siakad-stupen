<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumpulan extends Model
{
    protected $fillable = [
        'tugas_id',
        'agt_kelas_id',
        'des',
        'file',
        'status',
    ];

    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'tugas_id');
    }

    public function anggotaKelas()
    {
        return $this->belongsTo(AgtKelas::class, 'agt_kelas_id');
    }
}
