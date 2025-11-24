<?php

namespace App\Http\Controllers\guru\kelas;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KelasMapel;
use App\Models\Mapel;
use App\Models\MapelGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class GuruKelasController extends Controller
{
    public function index(){
        $guru = Guru::where('nip', Auth::user()->username)->first();
        
        $dataMapelGuru = MapelGuru::where('mapel_id', Auth::user()->mapel_id)->where('guru_id', $guru->id)->get();
        $mapel = Mapel::find(Auth::user()->mapel_id);

        return view('guru.kelas.index',[
            'mapel' => $mapel,
            'dataMapelGuru' => $dataMapelGuru,
            'type_menu'=>''
        ]);
    }
    public function detail($kelas_mapel_id){
        $kelasMapel = KelasMapel::find(decrypt($kelas_mapel_id));
        
        $kelas = Kelas::find($kelasMapel->kelas_id);
        
        return view('guru.kelas.detail',[
            'kelas' => $kelas,
            'kelasMapel' => $kelasMapel,
            'type_menu'=>''
        ]);
    }

    public function tugas(){
        return view('guru.kelas.tugas.index',['type_menu'=>'']);
    }
}
