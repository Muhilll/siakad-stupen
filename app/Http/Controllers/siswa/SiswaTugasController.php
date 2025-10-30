<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiswaTugasController extends Controller
{
    public function index(){
        return view('siswa.tugas.index', ['type_menu'=>'']);
    }
}
