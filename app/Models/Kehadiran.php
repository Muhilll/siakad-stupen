<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $fillable = [
        'ket',
        'status',
        'agt_kelas_id',
        'absensi_id',
    ];

    public function anggotaKelas()
    {
        return $this->belongsTo(AgtKelas::class, 'agt_kelas_id');
    }

    public function kelasMapel()
    {
        return $this->belongsTo(KelasMapel::class, 'kelas_mapel_id');
    }

    public function absensi()
    {
        return $this->belongsTo(Absensi::class, 'absensi_id');
    }
}
