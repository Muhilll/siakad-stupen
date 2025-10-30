<?php

namespace App\Http\Controllers\siswa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiswaMapelController extends Controller
{
    public function index(){
        return view('siswa.mapel.index',['type_menu'=>'']);
    }

    public function detail(){
        return view('siswa.mapel.detail',['type_menu'=>'']);
    }
    public function guru(){
        return view('siswa.mapel.guru',['type_menu'=>'']);
    }

    public function materi(){
        return view('siswa.mapel.materi.index',['type_menu'=>'']);
    }

    public function tugas(){
        return view('siswa.mapel.tugas.index',['type_menu'=>'']);
    }

    public function tugasDetail(){
        return view('siswa.mapel.tugas.detail',['type_menu'=>'']);
    }
}
