<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDataPenggunaController extends Controller
{
    public function guru()
    {
        return view('admin.data-pengguna.guru.index', ['type_menu'=>'data-pengguna']);
    }
    public function siswa()
    {
        return view('admin.data-pengguna.siswa.index', ['type_menu'=>'data-pengguna']);
    }

    public function admin()
    {
        return view('admin.data-pengguna.admin.index', ['type_menu'=>'data-pengguna']);
    }
}
