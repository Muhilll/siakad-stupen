<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminTugasController extends Controller
{
    public function index(){
        return view('admin.tugas.index', ['type_menu'=>'']);
    }
}
