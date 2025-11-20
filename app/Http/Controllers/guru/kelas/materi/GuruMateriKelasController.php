<?php

namespace App\Http\Controllers\guru\kelas\materi;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GuruMateriKelasController extends Controller
{
    public function index($kelas_mapel_id)
    {
        $decryptedKelasMapelId =  decrypt($kelas_mapel_id);

        return view('guru.kelas.materi.index', [
            'kelas_mapel_id' => $decryptedKelasMapelId,
            'type_menu' => ''
        ]);
    }

    public function data(Request $request, $kelas_mapel_id)
    {
        $perPage = 10;
        $query = Materi::where('kelas_mapel_id', $kelas_mapel_id);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
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

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'des' => 'required|string',
            'kelas_mapel_id' => 'required|integer|exists:kelas_mapels,id',
            'file' => 'required|file|max:10240|mimes:pdf,doc,docx,ppt,pptx,zip,rar'
        ]);

        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('materi', $fileName, 'public');
        }


        $materi = Materi::create([
            'nama' => $request->nama,
            'des' => $request->des,
            'file' => $fileName,
            'kelas_mapel_id' => $request->kelas_mapel_id,
        ]);

        return response()->json(['success' => true, 'message' => 'Materi berhasil ditambahkan', 'materi' => $materi]);
    }

    public function show($id)
    {
        $materi = Materi::findOrFail($id);
        return response()->json(['materi' => $materi]);
    }

    public function update(Request $request, $id)
    {
        $materi = Materi::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'des' => 'required|string',
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,ppt,pptx,zip,rar'
        ]);

        if ($request->hasFile('file')) {
            if ($materi->file && Storage::disk('public')->exists('materi/' . $materi->file)) {
                Storage::disk('public')->delete('materi/' . $materi->file);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

            $file->storeAs('materi', $fileName, 'public');

            $materi->file = $fileName;
        }


        $materi->nama = $request->nama;
        $materi->des = $request->des;
        $materi->save();

        return response()->json(['success' => true, 'message' => 'Materi berhasil diupdate', 'materi' => $materi]);
    }

    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);

        if ($materi->file && Storage::disk('public')->exists('materi/' . $materi->file)) {
            Storage::disk('public')->delete('materi/' . $materi->file);
        }

        $materi->delete();

        return response()->json(['success' => true, 'message' => 'Materi berhasil dihapus']);
    }
}
