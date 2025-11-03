<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminMapelController extends Controller
{
    public function index(){
        return view('admin.mapel.index', ['type_menu'=>'']);
    }

    public function guru(){
        return view('admin.mapel.guru.index', ['type_menu'=>'']);
    }
}
