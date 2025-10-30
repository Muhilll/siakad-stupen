<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $fillable = [
        'nama',
        'des',
    ];

    public function gurus()
    {
        return $this->belongsToMany(Guru::class, 'mapel_guru');
    }

    public function kelasMapel()
    {
        return $this->hasMany(KelasMapel::class);
    }
}
