<?php

namespace App\Http\Controllers\siswa\mapel\absensi;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\AgtKelas;
use App\Models\Kehadiran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaAbsensiKelasController extends Controller
{
    public function index($kelas_mapel_id)
    {
        $decryptedId = decrypt($kelas_mapel_id);

        $username = Auth::user()->username;
        $siswa = Siswa::where('nis', $username)->first();
        $agtKelasId = AgtKelas::where('siswa_id', $siswa->id)->first()->id;

        $dataAbsensi = Absensi::where('kelas_mapel_id', $decryptedId)
            ->with(['kehadiran' => function ($q) use ($agtKelasId) {
                $q->where('agt_kelas_id', $agtKelasId);
            }])
            ->get();

        $absensi = Absensi::where('kelas_mapel_id', $decryptedId)->first();

        return view('siswa.mapel.absensi.index', [
            'absensi' => $absensi,
            'dataAbsensi' => $dataAbsensi,
            'type_menu' => ''
        ]);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'absensi_id' => 'required',
            'ket' => 'required|in:Hadir,Izin,Alpa',
        ]);

        $username = Auth::user()->username;
        $siswa = Siswa::where('nis', $username)->first();
        $agtKelasId = AgtKelas::where('siswa_id', $siswa->id)->first()->id;

        // Cek apakah sudah absen
        $cek = Kehadiran::where('absensi_id', $request->absensi_id)
            ->where('agt_kelas_id', $agtKelasId)
            ->first();

        if ($cek) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah melakukan absensi.'
            ], 400);
        }

        $absensi = Absensi::find($request->absensi_id);
        $status = now() <= $absensi->batas ? 'Terkirim' : 'Terlambat';

        Kehadiran::create([
            'absensi_id' => $request->absensi_id,
            'agt_kelas_id' => $agtKelasId,
            'ket' => $request->ket,
            'status' => $status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Absensi berhasil disubmit!'
        ]);
    }
}
