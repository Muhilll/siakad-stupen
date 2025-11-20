<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuruAbsensiController extends Controller
{
     public function index(){
        return view('guru.absensi.index', ['type_menu'=>'']);
    }
}
