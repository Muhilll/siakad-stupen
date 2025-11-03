<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminMateriController extends Controller
{
    public function index(){
        return view('admin.materi.index', ['type_menu'=>'']);
    }
}
