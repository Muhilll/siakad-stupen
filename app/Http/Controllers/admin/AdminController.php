<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\MapelGuru;
use App\Models\Siswa;
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

    public function searchGuru(Request $request)
    {
        $keyword = $request->keyword;

        $guru = Guru::where('nama_lengkap', 'like', "%{$keyword}%")
            ->orWhere('nip', 'like', "%{$keyword}%")
            ->limit(20) // batasi agar tidak berat
            ->get();

        return response()->json($guru);
    }

    public function searchSiswa(Request $request)
    {
        $keyword = $request->keyword;

        $siswa = Siswa::where('nama', 'like', "%{$keyword}%")
            ->orWhere('nis', 'like', "%{$keyword}%")
            ->limit(20) // batasi agar tidak berat
            ->get();

        return response()->json($siswa);
    }

    public function mapelSearch(Request $request)
    {
        $search = $request->search;

        $mapel = Mapel::when($search, function ($q) use ($search) {
            $q->where('nama', 'like', "%{$search}%");
        })
            ->limit(20)
            ->get();

        return response()->json($mapel);
    }

    public function getGuruByMapel(Request $request, $mapel_id)
    {
        $search = $request->search;

        $guruList = MapelGuru::with('guru')
            ->where('mapel_id', $mapel_id)
            ->when($search, function ($q) use ($search) {
                $q->whereHas('guru', function ($g) use ($search) {
                    $g->where('nama_lengkap', 'like', "%{$search}%");
                });
            })
            ->limit(20)
            ->get();

        return response()->json($guruList);
    }
}
