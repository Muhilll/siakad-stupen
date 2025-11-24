<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $admin = User::where('role', 'admin')->count();
        $guru = User::where('role', 'guru')->count();
        $siswa = User::where('role', 'siswa')->count();
        $kelas = Kelas::count();
        return view('admin.dashboard', [
            'admin' => $admin,
            'guru' => $guru,
            'siswa' => $siswa,
            'kelas' => $kelas,
            'type_menu' => ''
        ]);
    }
}