<?php

namespace App\Http\Controllers\siswa\mapel\materi;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;

class SiswaMateriController extends Controller
{
    public function index($kelas_mapel_id)
    {
        $decryptedKelasMapelId =  decrypt($kelas_mapel_id);
        $dataMateri = Materi::where('kelas_mapel_id', $decryptedKelasMapelId)->get();
        $materi = Materi::where('kelas_mapel_id', $decryptedKelasMapelId)->first(); 

        return view('siswa.mapel.materi.index', [
            'materi' => $materi,
            'dataMateri' => $dataMateri,
            'type_menu' => ''
        ]);
    }

    public function detailMateri($materi_id)
    {
        $materi = Materi::with('kelasMapel.mapelGuru.guru')->findOrFail(decrypt($materi_id));

        return response()->json([
            'materi' => $materi,
            'guru' => $materi->kelasMapel->mapelGuru->guru->nama_lengkap
        ]);
    }
}
