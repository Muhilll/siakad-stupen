<?php

namespace App\Http\Controllers\admin\absensi;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Kehadiran;
use App\Models\Kelas;
use App\Models\KelasMapel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AdminAbsensiController extends Controller
{
    public function index()
    {
        return view('admin.absensi.index', [
            'absensiList' => [],
            'result' => [],
            'dataKelas' => Kelas::all(),
            'type_menu' => ''
        ]);
    }

    public function getTanggal(Request $r)
    {
        $kelasMapelIds = KelasMapel::where('kelas_id', $r->kelas_id)
            ->pluck('id');

        $tanggal = Absensi::whereIn('kelas_mapel_id', $kelasMapelIds)
            ->selectRaw('DATE(created_at) as tanggal')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'desc')
            ->get();

        return response()->json($tanggal);
    }

    public function getData(Request $request)
    {
        $kelasId = $request->kelas_id;
        $tanggal = $request->tanggal; // format: YYYY-MM-DD

        // Ambil semua kelas_mapel_id berdasarkan kelas yang dipilih
        $kelasMapelIds = KelasMapel::where('kelas_id', $kelasId)->pluck('id');

        // Ambil absensi sesuai kelas_mapel_id + tanggal
        $absensiList = Absensi::with(['kelasMapel.mapelGuru.mapel'])
            ->whereIn('kelas_mapel_id', $kelasMapelIds)
            ->whereDate('created_at', $tanggal)
            ->orderBy('id')
            ->get()
            ->groupBy('kelas_mapel_id')
            ->map(function ($group) {
                return $group->first();
            })
            ->values(); // reset index collection agar rapi

        // Ambil kehadiran dari daftar absensi yang telah difilter
        $dataKehadiran = Kehadiran::with(['anggotaKelas.siswa'])
            ->whereIn('absensi_id', $absensiList->pluck('id'))
            ->get();

        // Susun format result sesuai format Anda
        $result = [];

        foreach ($dataKehadiran as $k) {
            $siswaId   = $k->anggotaKelas->siswa->id;
            $absensiId = $k->absensi_id;

            $result[$siswaId]['siswa'] = $k->anggotaKelas->siswa;
            $result[$siswaId]['kehadiran'][$absensiId] = [
                'status' => $k->status,
                'ket' => $k->ket,
                'created_at' => $k->created_at
            ];
        }

        return response()->json([
            'absensiList' => $absensiList,
            'result'      => $result
        ]);
    }

    public function cetakPdf(Request $request){
        $request->validate([
            'kelas_id' => 'required',
            'tanggal' => 'required',
        ]);
        $kelasId = $request->kelas_id;
        $tanggal = $request->tanggal;
        $kelasMapelIds = KelasMapel::where('kelas_id', $kelasId)->pluck('id');
        $absensiList = Absensi::whereIn('kelas_mapel_id', $kelasMapelIds)
            ->whereDate('created_at', $tanggal)    
            ->orderBy('id')
            ->get()
            ->groupBy('kelas_mapel_id')
            ->map(function ($group) {
                return $group->first();
            });

        $dataKehadiran = Kehadiran::with(['anggotaKelas.siswa'])
            ->whereIn('absensi_id', $absensiList->pluck('id'))
            ->get();

        $result = [];

        foreach ($dataKehadiran as $k) {
            $siswaId = $k->anggotaKelas->siswa->id;
            $absensiId = $k->absensi_id;

            $result[$siswaId]['siswa'] = $k->anggotaKelas->siswa;
            $result[$siswaId]['kehadiran'][$absensiId] = [
                'ket' => $k->ket,
                'created_at' => $k->created_at
            ];
        }

        $pdf = PDF::loadView('admin.absensi.cetak', [
            'absensiList' => $absensiList,
            'result' => $result,
            'type_menu' => ''
        ]);

        $kelas = Kelas::find($kelasId);
        return $pdf->stream('laporan-absensi-kelas '.$kelas->kode.' - tanggal '.$tanggal.'.pdf');
    }
}
