<?php

namespace App\Http\Controllers\guru\kelas;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\MapelGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class GuruKelasController extends Controller
{
    public function index(){
        $guru = Guru::where('nip', Auth::user()->username)->first();
        
        $dataMapelGuru = MapelGuru::where('mapel_id', Auth::user()->mapel_id)->where('guru_id', $guru->id)->get();
        
        return view('guru.kelas.index',[
            'dataMapelGuru' => $dataMapelGuru,
            'type_menu'=>''
        ]);
    }
    public function detail($kelas_mapel_id){
        
        return view('guru.kelas.detail',[
            'kelas_mapel_id' => $kelas_mapel_id,
            'type_menu'=>''
        ]);
    }

    public function tugas(){
        return view('guru.kelas.tugas.index',['type_menu'=>'']);
    }
}
