<?php

namespace App\Http\Controllers\admin\mapel\guru;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use App\Models\Guru;
use App\Models\MapelGuru;
use Illuminate\Http\Request;

class AdminPengajarController extends Controller
{
    // Index (POST)
    public function index(Request $request)
    {
        $mapel = Mapel::findOrFail($request->id);
        $guru = Guru::all();

        return view('admin.mapel.guru.index', [
            'type_menu' => '',
            'mapel' => $mapel,
            'dataGuru' => $guru
        ]);
    }

    // Data AJAX
    public function data(Request $request, $mapel_id)
    {
        $perPage = 10;
        $query = MapelGuru::with('guru')->where('mapel_id', $mapel_id);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('guru', function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        $pengajars = $query->orderBy('id', 'desc')->paginate($perPage);

        return response()->json([
            'data' => $pengajars->items(),
            'pagination' => (string) $pengajars->links('pagination::bootstrap-4')
        ]);
    }

    // Store AJAX
    public function store(Request $request, $mapel_id)
    {
        $request->validate([
            'guru_id' => 'required|exists:gurus,id',
        ]);

        MapelGuru::create([
            'mapel_id' => $mapel_id,
            'guru_id' => $request->guru_id,
        ]);

        return response()->json(['success' => true, 'message' => 'Pengajar berhasil ditambahkan']);
    }

    // Show AJAX
    public function show($id)
    {
        $pengajar = MapelGuru::with('guru')->findOrFail($id);
        return response()->json(['pengajar' => $pengajar]);
    }

    // Update AJAX
    public function update(Request $request, $id)
    {
        $request->validate([
            'guru_id' => 'required|exists:gurus,id',
        ]);

        $pengajar = MapelGuru::findOrFail($id);
        $pengajar->update([
            'guru_id' => $request->guru_id,
        ]);

        return response()->json(['success' => true, 'message' => 'Pengajar berhasil diupdate']);
    }

    // Delete AJAX
    public function destroy($id)
    {
        $pengajar = MapelGuru::findOrFail($id);
        $pengajar->delete();

        return response()->json(['success' => true, 'message' => 'Pengajar berhasil dihapus']);
    }
}
