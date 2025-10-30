<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuruKelasController extends Controller
{
    public function index(){
        return view('guru.kelas.index',['type_menu'=>'']);
    }
    public function detail(){
        return view('guru.kelas.detail',['type_menu'=>'']);
    }
    public function siswa(){
        return view('guru.kelas.siswa',['type_menu'=>'']);
    }
    public function materi(){
        return view('guru.kelas.materi.index',['type_menu'=>'']);
    }
    public function tugas(){
        return view('guru.kelas.tugas.index',['type_menu'=>'']);
    }
}
