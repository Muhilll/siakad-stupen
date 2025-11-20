<?php

namespace App\Http\Controllers\guru\kelas\siswa;

use App\Http\Controllers\Controller;
use App\Models\AgtKelas;
use App\Models\KelasMapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class GuruAgtKelasController extends Controller
{
    public function index($kelas_mapel_id)
    {
        try {
            $decryptedKelasMapelId = decrypt($kelas_mapel_id);
            $kelasMapel = KelasMapel::find($decryptedKelasMapelId);

            return view('guru.kelas.siswa.index', [
                'kelas_id' => $kelasMapel->kelas_id,
                'type_menu' => ''
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Invalid ID Kelas');
        }
    }

    public function data(Request $request, $kelas_id)
    {
        $perPage = 10;
        $query = AgtKelas::with('siswa')->where('kelas_id', $kelas_id);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('siswa', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%")
                    ->orWhere('nisn', 'like', "%{$search}%");
            });
        }

        $list = $query->orderBy('id', 'desc')->paginate($perPage);

        return response()->json([
            'data' => $list->items(),
            'pagination' => (string) $list->links('pagination::bootstrap-4')
        ]);
    }

    public function show($id)
    {
        $agt = AgtKelas::with('siswa')->findOrFail($id);
        return response()->json(['siswa' => $agt->siswa]);
    }
}
