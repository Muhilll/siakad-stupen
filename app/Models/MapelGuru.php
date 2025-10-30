<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MapelGuru extends Model
{
    protected $fillable = [
        'mapel_id',
        'guru_id',
    ];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function kelasMapel()
    {
        return $this->hasMany(KelasMapel::class, 'mapel_guru_id');
    }
}
