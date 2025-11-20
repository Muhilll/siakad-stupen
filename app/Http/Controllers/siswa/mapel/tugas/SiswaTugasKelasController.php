<?php

namespace App\Http\Controllers\siswa\mapel\tugas;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use Illuminate\Http\Request;

class SiswaTugasKelasController extends Controller
{
    public function index($kelas_mapel_id){
        $decryptedKelasMapelId =  decrypt($kelas_mapel_id);

        $dataTugas = Tugas::where('kelas_mapel_id', $decryptedKelasMapelId)->get();
        
        return view('siswa.mapel.tugas.index',[
            'dataTugas' => $dataTugas,
            'type_menu'=>''
        ]);
    }

    public function detail($id){
        $decryptedTugasId =  decrypt($id);
        $tugas = Tugas::find($decryptedTugasId);
        
        return view('siswa.mapel.tugas.detail',[
            'tugas' => $tugas,
            'type_menu'=>''
        ]);
    }
}
