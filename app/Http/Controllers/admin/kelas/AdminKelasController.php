<?php

namespace App\Http\Controllers\admin\kelas;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AdminKelasController extends Controller
{
    public function index()
    {
        return view('admin.kelas.index', [
            'type_menu' => ''
        ]);
    }


    public function data(Request $request)
    {
        $perPage = 10;
        $query = Kelas::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('tingkat', 'like', "%{$search}%")
                ->orWhere('kode', 'like', "%{$search}%");
        }

        $kelas = $query->orderBy('id', 'desc')->paginate($perPage);

        $kelas->getCollection()->transform(function ($item) {
            $item->encrypted_id = Crypt::encrypt($item->id);
            return $item;
        });

        return response()->json([
            'data' => $kelas->items(),
            'pagination' => (string) $kelas->links('pagination::bootstrap-4')
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'tingkat' => 'required|string|max:10',
            'kode' => 'required|string|max:20',
        ]);

        Kelas::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Kelas berhasil disimpan'
        ]);
    }

    public function show($id)
    {
        $kelas = Kelas::find($id);
        return response()->json(['kelas' => $kelas]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tingkat' => 'required|string|max:10',
            'kode' => 'required|string|max:20',
        ]);

        $kelas = Kelas::find($id);
        $kelas->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Kelas berhasil diupdate'
        ]);
    }

    public function destroy($id)
    {
        $kelas = Kelas::find($id);
        $kelas->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kelas berhasil dihapus'
        ]);
    }

    public function detail($kelas_id)
    {
        return view('admin.kelas.detail', [
            'kelas_id' => $kelas_id,
            'type_menu' => ''
        ]);
    }

    public function mapel()
    {
        return view('admin.kelas.mapel.index', ['type_menu' => '']);
    }
}
