<?php

namespace App\Http\Controllers\guru\kelas\absensi\kehadiran;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Kehadiran;
use App\Models\KelasMapel;
use Illuminate\Http\Request;

class GuruKehadiranKelasController extends Controller
{
    public function index($absensi_id)
    {
        $decryptedAbsensiId = decrypt($absensi_id);

        $absensi = Absensi::findOrFail($decryptedAbsensiId);
        $kelasMapel = KelasMapel::find($absensi->kelas_mapel_id);

        return view('guru.kelas.absensi.kehadiran.index', [
            'absensi' => $absensi,
            'kelasMapel' => $kelasMapel,
            'absensi_id' => $decryptedAbsensiId,
            'type_menu' => 'guru.kelas'
        ]);
    }

    // Data AJAX
        public function data(Request $request, $absensi_id)
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
}
