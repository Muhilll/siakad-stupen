<?php

namespace App\Http\Controllers\admin\data_pengguna;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AdminSiswaController extends Controller
{

    public function data(Request $request)
    {
        $perPage = 10;
        $query = Siswa::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('nis', 'like', "%{$search}%")
                ->orWhere('nisn', 'like', "%{$search}%");
        }

        $siswas = $query->orderBy('id', 'desc')->paginate($perPage);

        return response()->json([
            'data' => $siswas->items(),
            'pagination' => (string) $siswas->links('pagination::bootstrap-4')
        ]);
    }

    public function index()
    {
        return view('admin.data-pengguna.siswa.index', [
            'type_menu' => 'data-pengguna'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'nisn' => 'required|unique:siswas',
            'nama' => 'required',
            'jkl' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'agama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'tahun_masuk' => 'required|integer',
            'status' => 'required',
            'nama_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'nama_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'nohp_ortu' => 'required',
        ]);

        Siswa::create($request->all());
        return response()->json(['success' => true, 'message' => 'Data siswa berhasil disimpan']);
    }

    public function show($id)
    {
        $siswa = Siswa::find($id);
        return response()->json(['siswa' => $siswa]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required',
            'nisn' => "required|unique:siswas,nisn,$id",
            'nama' => 'required',
            'jkl' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'agama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'tahun_masuk' => 'required|integer',
            'status' => 'required',
            'nama_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'nama_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'nohp_ortu' => 'required',
        ]);

        $siswa = Siswa::find($id);
        $siswa->update($request->all());

        return response()->json(['success' => true, 'message' => 'Data siswa berhasil diupdate']);
    }

    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete();

        return response()->json(['success' => true, 'message' => 'Data siswa berhasil dihapus']);
    }
}
