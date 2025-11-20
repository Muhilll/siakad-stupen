<?php

namespace App\Http\Controllers\siswa\mapel\guru;

use App\Http\Controllers\Controller;
use App\Models\KelasMapel;
use App\Models\MapelGuru;
use Illuminate\Http\Request;

class SiswaPengajarController extends Controller
{
    public function index($kelas_mapel_id){
        
        $decryptedKelasMapelId =  decrypt($kelas_mapel_id);
        $kelasMapel = KelasMapel::find($decryptedKelasMapelId);
        $mapelGuru = MapelGuru::find($kelasMapel->mapel_guru_id);
        return view('siswa.mapel.guru',[
            'guru' => $mapelGuru->guru,
            'type_menu'=>''
        ]);
    }
}
