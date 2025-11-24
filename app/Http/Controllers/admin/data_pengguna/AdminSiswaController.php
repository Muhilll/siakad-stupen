<?php

namespace App\Http\Controllers\admin\data_pengguna;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class AdminSiswaController extends Controller
{
    public function index()
    {
        return view('admin.data-pengguna.siswa.index', [
            'type_menu' => 'data-pengguna'
        ]);
    }
    
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

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|digits_between:4,20',
            'nisn' => 'required|digits_between:10,20|unique:siswas,nisn',
            'nama' => 'nullable',
            'jkl' => 'nullable',
            'tmp_lahir' => 'nullable',
            'tgl_lahir' => 'nullable|date',
            'agama' => 'nullable',
            'alamat' => 'nullable',
            'no_hp' => ['nullable', 'regex:/^(0|62)[0-9]{9,14}$/'],
            'tahun_masuk' => 'nullable|integer|between:2000,' . (date('Y') + 1),
            'status' => 'nullable',
            'nama_ayah' => 'nullable',
            'pekerjaan_ayah' => 'nullable',
            'nama_ibu' => 'nullable',
            'pekerjaan_ibu' => 'nullable',
            'nohp_ortu' => ['nullable', 'regex:/^(0|62)[0-9]{9,14}$/'],
        ]);


        Siswa::create($request->all());

        User::create([
            'username' => $request->nis,
            'role' => 'siswa',
            'password' => bcrypt($request->nis),
        ]);
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
            'nis' => 'required|digits_between:4,20',
            'nisn' => "required|digits_between:10,20|unique:siswas,nisn,$id",
            'nama' => 'nullable',
            'jkl' => 'nullable',
            'tmp_lahir' => 'nullable',
            'tgl_lahir' => 'nullable|date',
            'agama' => 'nullable',
            'alamat' => 'nullable',
            'no_hp' => ['nullable', 'regex:/^(0|62)[0-9]{9,14}$/'],
            'tahun_masuk' => 'nullable|integer|between:2000,' . (date('Y') + 1),
            'status' => 'nullable',
            'nama_ayah' => 'nullable',
            'pekerjaan_ayah' => 'nullable',
            'nama_ibu' => 'nullable',
            'pekerjaan_ibu' => 'nullable',
            'nohp_ortu' => ['nullable', 'regex:/^(0|62)[0-9]{9,14}$/'],
        ]);


        $siswa = Siswa::find($id);
        $user = User::where('username', $siswa->nis)->first();

        $siswa->update($request->all());
        $user->username = $siswa->nis;
        $user->save();

        return response()->json(['success' => true, 'message' => 'Data siswa berhasil diupdate']);
    }

    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete();

        return response()->json(['success' => true, 'message' => 'Data siswa berhasil dihapus']);
    }
}
