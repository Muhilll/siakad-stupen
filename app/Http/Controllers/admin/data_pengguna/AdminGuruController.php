<?php

namespace App\Http\Controllers\admin\data_pengguna;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;

class AdminGuruController extends Controller
{
    public function data(Request $request)
    {
        $perPage = 10;
        $query = Guru::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_lengkap', 'like', "%{$search}%")
                ->orWhere('nip', 'like', "%{$search}%")
                ->orWhere('nik', 'like', "%{$search}%");
        }

        $gurus = $query->orderBy('id', 'desc')->paginate($perPage);

        return response()->json([
            'data' => $gurus->items(),
            'pagination' => (string) $gurus->links('pagination::bootstrap-4')
        ]);
    }

    public function index()
    {
        return view('admin.data-pengguna.guru.index', [
            'type_menu' => 'data-pengguna'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_ptk' => 'required',
            'nama_lengkap' => 'required',
            'nip' => 'nullable|numeric|unique:gurus,nip',
            'pangkat' => 'nullable',
            'golongan' => 'nullable',
            'tmt' => 'nullable|date',
            'mkg_cpns_tahun' => 'nullable|integer',
            'mkg_cpns_bulan' => 'nullable|integer',
            'mkg_total_tahun' => 'nullable|integer',
            'mkg_total_bulan' => 'nullable|integer',
            'nuptk' => 'nullable|numeric|unique:gurus,nuptk',
            'nik' => 'nullable|digits:16|unique:gurus,nik',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required',
            'no_hp' => ['nullable', 'regex:/^(0|62)[0-9]{9,14}$/'],
            'email' => 'nullable|email|unique:gurus,email',
            'jabatan' => 'nullable',
            'sertifikasi_bidang_studi' => 'nullable',
            'sertifikasi_tahun' => 'nullable|digits:4',
            'pendidikan_jenjang' => 'nullable',
            'pendidikan_gelar' => 'nullable',
            'pendidikan_bidang_studi' => 'nullable',
            'pendidikan_tahun' => 'nullable|digits:4',
        ]);

        Guru::create($request->all());
        return response()->json(['success' => true, 'message' => 'Data guru berhasil disimpan']);
    }

    public function show($id)
    {
        $guru = Guru::find($id);
        return response()->json(['guru' => $guru]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_ptk' => 'required',
            'nama_lengkap' => 'required',
            'nip' => 'nullable|numeric|unique:gurus,nip,' . $id,
            'pangkat' => 'nullable',
            'golongan' => 'nullable',
            'tmt' => 'nullable|date',
            'mkg_cpns_tahun' => 'nullable|integer',
            'mkg_cpns_bulan' => 'nullable|integer',
            'mkg_total_tahun' => 'nullable|integer',
            'mkg_total_bulan' => 'nullable|integer',
            'nuptk' => 'nullable|numeric|unique:gurus,nuptk,' . $id,
            'nik' => 'nullable|digits:16|unique:gurus,nik,' . $id,
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required',
            'no_hp' => ['nullable', 'regex:/^(0|62)[0-9]{9,14}$/'],
            'email' => 'nullable|email|unique:gurus,email,' . $id,
            'jabatan' => 'nullable',
            'sertifikasi_bidang_studi' => 'nullable',
            'sertifikasi_tahun' => 'nullable|digits:4',
            'pendidikan_jenjang' => 'nullable',
            'pendidikan_gelar' => 'nullable',
            'pendidikan_bidang_studi' => 'nullable',
            'pendidikan_tahun' => 'nullable|digits:4',
        ]);

        $guru = Guru::find($id);
        $guru->update($request->all());

        return response()->json(['success' => true, 'message' => 'Data guru berhasil diupdate']);
    }

    public function destroy($id)
    {
        $guru = Guru::find($id);
        $guru->delete();

        return response()->json(['success' => true, 'message' => 'Data guru berhasil dihapus']);
    }
}
