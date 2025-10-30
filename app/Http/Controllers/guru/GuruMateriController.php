<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuruMateriController extends Controller
{
    public function index(){
        return view('guru.materi.index', ['type_menu'=>'']);
    }
}
