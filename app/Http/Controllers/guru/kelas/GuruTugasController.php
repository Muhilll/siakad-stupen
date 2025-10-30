<?php

namespace App\Http\Controllers\guru\kelas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuruTugasController extends Controller
{
    public function index(){
        return view('guru.tugas.index', ['type_menu'=>'']);
    }
}
