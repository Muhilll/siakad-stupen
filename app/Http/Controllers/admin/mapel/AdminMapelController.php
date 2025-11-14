<?php

namespace App\Http\Controllers\admin\mapel;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use App\Models\MapelGuru;
use Illuminate\Http\Request;

class AdminMapelController extends Controller
{


    public function data(Request $request)
    {
        $perPage = 10;
        $query = Mapel::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('des', 'like', "%{$search}%");
        }

        $mapels = $query->orderBy('id', 'desc')->paginate($perPage);

        return response()->json([
            'data' => $mapels->items(),
            'pagination' => (string) $mapels->links('pagination::bootstrap-4')
        ]);
    }

    public function index()
    {
        return view('admin.mapel.index', [
            'type_menu' => ''
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'des' => 'nullable|string',
        ]);

        Mapel::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Mata pelajaran berhasil disimpan'
        ]);
    }

    public function show($id)
    {
        $mapel = Mapel::find($id);
        return response()->json(['mapel' => $mapel]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'des' => 'nullable|string',
        ]);

        $mapel = Mapel::find($id);
        $mapel->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Mata pelajaran berhasil diupdate'
        ]);
    }

    public function destroy($id)
    {
        $mapel = Mapel::find($id);
        $mapel->delete();

        return response()->json([
            'success' => true,
            'message' => 'Mata pelajaran berhasil dihapus'
        ]);
    }

    public function pengajar(Request $request)
    {
        $mapelId = $request->query('id');
        $mapel = Mapel::find($mapelId);

        return view('admin.mapel.guru.index', [
            'type_menu' => '',
            'mapel' => $mapel
        ]);
    }
}
