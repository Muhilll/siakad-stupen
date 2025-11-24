<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $guru = User::where('role', 'guru')->count();
        $siswa = User::where('role', 'siswa')->count();
        $kelas = Kelas::count();
        return view('guru.dashboard', [
            'guru' => $guru,
            'siswa' => $siswa,
            'kelas' => $kelas,
            'type_menu' => ''
        ]);
    }
}
