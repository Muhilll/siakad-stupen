<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AdminDataPenggunaController extends Controller
{
    public function guru()
    {
        return view('admin.data-pengguna.guru.index', ['type_menu'=>'data-pengguna']);
    }

    public function siswa()
    {
        $siswas = Siswa::latest()->get();
        return view('admin.data-pengguna.siswa.index', [
            'siswas' => $siswas,
            'type_menu' => 'data-pengguna'
        ]);
    }

    public function admin()
    {
        return view('admin.data-pengguna.admin.index', ['type_menu'=>'data-pengguna']);
    }
}
