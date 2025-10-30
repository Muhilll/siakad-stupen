<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = [
        'tingkat',
        'kode',
    ];

    public function anggotaKelas()
    {
        return $this->hasMany(AgtKelas::class, 'kelas_id');
    }

    public function kelasMapel()
    {
        return $this->hasMany(KelasMapel::class, 'kelas_id');
    }
}
