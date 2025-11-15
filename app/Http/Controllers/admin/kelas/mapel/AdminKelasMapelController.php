<?php

namespace App\Http\Controllers\admin\kelas\mapel;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\MapelGuru;
use App\Models\KelasMapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AdminKelasMapelController extends Controller
{

    public function index($id)
    {
        try {
            $kelasId = Crypt::decrypt($id);
            $kelas = Kelas::findOrFail($kelasId);
            $mapel = Mapel::all();
            return view('admin.kelas.mapel.index', [
                'kelas' => $kelas,
                'mapel' => $mapel,
                'type_menu' => '',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Invalid ID Kelas');
        }
    }

    // Data AJAX
    public function data(Request $request, $kelas_id)
    {
        $perPage = 10;
        $query = KelasMapel::with(['mapelGuru', 'mapelGuru.guru', 'mapelGuru.mapel'])
            ->where('kelas_id', $kelas_id);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('mapelGuru.mapel', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            });
        }

        $list = $query->orderBy('id', 'desc')->paginate($perPage);

        return response()->json([
            'data' => $list->items(),
            'pagination' => (string) $list->links('pagination::bootstrap-4')
        ]);
    }

    // Store AJAX
    public function store(Request $request, $kelas_id)
    {
        $request->validate([
            'mapel_guru_id' => 'required|exists:mapel_gurus,id',
        ]);

        $mapelGuru = MapelGuru::findOrFail($request->mapel_guru_id);
        $duplikat = KelasMapel::where('kelas_id', $kelas_id)
            ->whereHas('mapelGuru', function ($q) use ($mapelGuru) {
                $q->where('mapel_id', $mapelGuru->mapel_id);
            })
            ->exists();

        if ($duplikat) {
            throw ValidationException::withMessages([
                'mapel_guru_id' => 'Mata pelajaran ini sudah terdaftar di kelas tersebut.',
            ]);
        }

        KelasMapel::create([
            'kelas_id' => $kelas_id,
            'mapel_guru_id' => $request->mapel_guru_id,
        ]);

        return response()->json(['success' => true, 'message' => 'Mata pelajaran berhasil ditambahkan']);
    }

    // Delete AJAX
    public function destroy($id)
    {
        $kelasMapel = KelasMapel::findOrFail($id);
        $kelasMapel->delete();

        return response()->json(['success' => true, 'message' => 'Mata pelajaran berhasil dihapus']);
    }

    // Ambil Guru berdasarkan Mapel
    public function getGuruByMapel($mapel_id)
    {
        $guruList = MapelGuru::with('guru')
            ->where('mapel_id', $mapel_id)
            ->get();

        return response()->json($guruList);
    }
}
