<?php

namespace App\Http\Controllers\siswa;
use App\Http\Controllers\Controller;
use App\Models\AgtKelas;
use App\Models\KelasMapel;
use App\Models\MapelGuru;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaMapelController extends Controller
{
    public function index(){
        $nis = Auth::user()->username;
        $siswa = Siswa::where('nis', $nis)->first();
        $agtKelas = AgtKelas::where('siswa_id', $siswa->id)->first();
        $dataKelasMapel = KelasMapel::where('kelas_id', $agtKelas->kelas_id)->get();

        return view('siswa.mapel.index',[
            'dataKelasMapel' => $dataKelasMapel,
            'type_menu'=>''
        ]);
    }

    public function detail($kelas_mapel_id){
        return view('siswa.mapel.detail',[
            'kelas_mapel_id' => $kelas_mapel_id,
            'type_menu'=>''
        ]);
    }

    public function tugas($kelas_mapel_id){
        
        
        return view('siswa.mapel.tugas.index',[
            'kelas_mapel_id' => $kelas_mapel_id,
            'type_menu'=>''
        ]);
    }

    public function tugasDetail(){
        return view('siswa.mapel.tugas.detail',['type_menu'=>'']);
    }
}
