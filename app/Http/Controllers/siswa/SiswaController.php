<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $guru = User::where('role', 'guru')->count();
        $siswa = User::where('role', 'siswa')->count();
        $kelas = Kelas::count();
        return view('siswa.dashboard', [
            'guru' => $guru,
            'siswa' => $siswa,
            'kelas' => $kelas,
            'type_menu' => ''
        ]);
    }
}
