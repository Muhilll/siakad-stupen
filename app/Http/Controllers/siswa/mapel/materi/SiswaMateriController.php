<?php

namespace App\Http\Controllers\siswa\mapel\materi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiswaMateriController extends Controller
{
    public function index($kelas_mapel_id){
        // $decryptedKelasMapelId =  decrypt($kelas_mapel_id);

        return view('siswa.mapel.materi.index',['type_menu'=>'']);
    }
}
