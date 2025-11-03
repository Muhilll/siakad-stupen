<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminKelasController extends Controller
{
    public function index()
    {
        return view('admin.kelas.index',['type_menu'=>'']);
    }

    public function detail()
    {
        return view('admin.kelas.detail',['type_menu'=>'']);
    }

    public function siswa()
    {
        return view('admin.kelas.siswa.index',['type_menu'=>'']);
    }

    public function mapel()
    {
        return view('admin.kelas.mapel.index',['type_menu'=>'']);
    }
}
