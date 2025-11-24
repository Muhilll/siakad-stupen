<?php

namespace App\Http\Controllers\guru\kelas\absensi;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\KelasMapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GuruAbsensiKelasController extends Controller
{
    public function index($kelas_mapel_id)
    {
        $kelasMapel = KelasMapel::find(decrypt($kelas_mapel_id));
        return view('guru.kelas.absensi.index', [
            'kelasMapel' => $kelasMapel,
            'type_menu' => ''
        ]);
    }

    public function data(Request $request, $kelas_mapel_id)
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

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'batas' => 'required|date',
            'kelas_mapel_id' => 'required|integer|exists:kelas_mapels,id'
        ]);

        $absensi = Absensi::create([
            'nama' => $request->nama,
            'batas' => $request->batas,
            'kelas_mapel_id' => $request->kelas_mapel_id
        ]);

        return response()->json(['success' => true, 'message' => 'Absensi berhasil ditambahkan', 'absensi' => $absensi]);
    }

    public function show($id)
    {
        $absensi = Absensi::findOrFail($id);
        return response()->json(['absensi' => $absensi]);
    }

    public function update(Request $request, $id)
    {
        $absensi = Absensi::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'batas' => 'required|date'
        ]);

        $absensi->nama = $request->nama;
        $absensi->batas = $request->batas;
        $absensi->save();

        return response()->json(['success' => true, 'message' => 'Absensi berhasil diupdate', 'absensi' => $absensi]);
    }

    public function destroy($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();

        return response()->json(['success' => true, 'message' => 'Absensi berhasil dihapus']);
    }
}
