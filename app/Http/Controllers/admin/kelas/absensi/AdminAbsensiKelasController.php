<?php

namespace App\Http\Controllers\admin\kelas\absensi;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\AgtKelas;
use App\Models\Kehadiran;
use App\Models\KelasMapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AdminAbsensiKelasController extends Controller
{
    public function index($kelas_id)
    {
        try {
            $kelasId = Crypt::decrypt($kelas_id);

            return view('admin.kelas.absensi.mapel', [
                'kelas_id' => $kelasId,
                'type_menu' => '',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Invalid ID Kelas');
        }
    }

    public function data(Request $request, $kelas_id)
    {
        $perPage = 10;

        $query = KelasMapel::with(['mapelGuru', 'mapelGuru.guru', 'mapelGuru.mapel'])
            ->where('kelas_id', $kelas_id);

        // SEARCH
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $query->whereHas('mapelGuru.mapel', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            });
        }

        $list = $query->orderBy('id', 'desc')->paginate($perPage);
        $list->getCollection()->transform(function ($item) {
            $item->encrypted_id = Crypt::encrypt($item->id);
            return $item;
        });

        return response()->json([
            'data' => $list->items(),
            'pagination' => (string) $list->links('pagination::bootstrap-4')
        ]);
    }

    public function absensi($kelas_mapel_id)
    {
        $decryptedKelasMapelId = decrypt($kelas_mapel_id);
        return view('admin.kelas.absensi.absensi', [
            'kelas_mapel_id' => $decryptedKelasMapelId,
            'type_menu' => ''
        ]);
    }

    public function dataAbsensi(Request $request, $kelas_mapel_id)
    {
        $perPage = 10;
        $query = Absensi::where('kelas_mapel_id', $kelas_mapel_id);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama', 'like', "%{$search}%");
        }

        $list = $query->orderBy('id', 'desc')->paginate($perPage);

        return response()->json([
            'data' => $list->items(),
            'pagination' => (string) $list->links('pagination::bootstrap-4')
        ]);
    }

    public function kehadiran($absensi_id)
    {
        $decryptedAbsensiId = decrypt($absensi_id);

        return view('admin.kelas.absensi.kehadiran.index', [
            'absensi_id' => $decryptedAbsensiId,
            'type_menu' => 'admin.kelas'
        ]);
    }

    public function dataKehadiran(Request $request, $absensi_id)
    {
        $perPage = 10;

        $query = Kehadiran::with(['anggotaKelas.siswa'])
            ->where('absensi_id', $absensi_id);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('anggotaKelas.siswa', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%");
            });
        }

        $list = $query->orderBy('id', 'desc')->paginate($perPage);

        return response()->json([
            'data' => $list->items(),
            'pagination' => (string) $list->links('pagination::bootstrap-4')
        ]);
    }

    public function showAgt($id)
    {
        $agt = AgtKelas::with('siswa')->findOrFail($id);
        return response()->json(['siswa' => $agt->siswa]);
    }
}
