<?php

namespace App\Http\Controllers\guru\kelas\tugas;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class GuruTugasKelasController extends Controller
{
    public function index($kelas_mapel_id)
    {
        $decryptedKelasMapelId = decrypt($kelas_mapel_id);

        return view('guru.kelas.tugas.index', [
            'kelas_mapel_id' => $decryptedKelasMapelId,
            'type_menu' => ''
        ]);
    }

    // Data AJAX (tabel)
    public function data(Request $request, $kelas_mapel_id)
    {
        $perPage = 10;
        $query = Tugas::where('kelas_mapel_id', $kelas_mapel_id);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('des', 'like', "%{$search}%");
            });
        }

        $list = $query->orderBy('id', 'desc')->paginate($perPage);

        return response()->json([
            'data' => $list->items(),
            'pagination' => (string) $list->links('pagination::bootstrap-4')
        ]);
    }

    // Store AJAX
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'des' => 'required|string',
            'batas' => 'required',
            'kelas_mapel_id' => 'required|integer|exists:kelas_mapels,id',
            'file' => 'required|file|max:10240|mimes:pdf,doc,docx,ppt,pptx,zip,rar'
        ]);

        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            // simpan ke storage/app/public/tugas
            $file->storeAs('tugas', $fileName, 'public');
        }

        // convert batas (datetime-local => Y-m-d H:i:s)
        $batas = Carbon::parse($request->batas)->format('Y-m-d H:i:s');

        $tugas = Tugas::create([
            'nama' => $request->nama,
            'des' => $request->des,
            'batas' => $batas,
            'file' => $fileName,
            'kelas_mapel_id' => $request->kelas_mapel_id,
        ]);

        return response()->json(['success' => true, 'message' => 'Tugas berhasil ditambahkan', 'tugas' => $tugas]);
    }

    // Show Detail AJAX
    public function show($id)
    {
        $tugas = Tugas::findOrFail($id);
        return response()->json(['tugas' => $tugas]);
    }

    // Update AJAX
    public function update(Request $request, $id)
    {
        $tugas = Tugas::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'des' => 'required|string',
            'batas' => 'required',
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,ppt,pptx,zip,rar'
        ]);

        if ($request->hasFile('file')) {
            // hapus file lama jika ada
            if ($tugas->file && Storage::disk('public')->exists('tugas/' . $tugas->file)) {
                Storage::disk('public')->delete('tugas/' . $tugas->file);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('tugas', $fileName, 'public');
            $tugas->file = $fileName;
        }

        $tugas->nama = $request->nama;
        $tugas->des = $request->des;
        $tugas->batas = Carbon::parse($request->batas)->format('Y-m-d H:i:s');
        $tugas->save();

        return response()->json(['success' => true, 'message' => 'Tugas berhasil diupdate', 'tugas' => $tugas]);
    }

    // Delete AJAX
    public function destroy($id)
    {
        $tugas = Tugas::findOrFail($id);

        if ($tugas->file && Storage::disk('public')->exists('tugas/' . $tugas->file)) {
            Storage::disk('public')->delete('tugas/' . $tugas->file);
        }

        $tugas->delete();

        return response()->json(['success' => true, 'message' => 'Tugas berhasil dihapus']);
    }
}
