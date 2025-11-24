<?php

namespace App\Http\Controllers\admin\kelas\siswa;

use App\Http\Controllers\Controller;
use App\Models\AgtKelas;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class AdminAgtKelasController extends Controller
{
    public function index($kelas_id)
    {
        try {
            $decryptedKelasId = Crypt::decrypt($kelas_id);

            $kelas = Kelas::findOrFail($decryptedKelasId);
            $siswa = Siswa::all();
            return view('admin.kelas.siswa.index', [
                'kelas' => $kelas,
                'siswa' => $siswa,
                'type_menu' => ''
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Invalid ID Kelas');
        }
    }

    // Data AJAX (tabel)
    public function data(Request $request, $kelas_id)
    {
        $perPage = 10;
        $query = AgtKelas::with('siswa')->where('kelas_id', $kelas_id);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('siswa', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%")
                    ->orWhere('nisn', 'like', "%{$search}%");
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
            'siswa_id' => [
                'required',
                function ($attribute, $value, $fail) use ($kelas_id) {
                    $already = AgtKelas::with('kelas')
                        ->where('siswa_id', $value)
                        ->where('kelas_id', '!=', $kelas_id)
                        ->first();

                    if ($already) {
                        $kelasNama = $already->kelas->kode ?? 'Kelas lain';

                        return $fail("Siswa ini sudah terdaftar di kelas lain: {$kelasNama}.");
                    }

                    if (AgtKelas::where('siswa_id', $value)
                        ->where('kelas_id', $kelas_id)
                        ->exists()
                    ) {
                        return $fail('Siswa ini sudah terdaftar dalam kelas ini.');
                    }
                },
            ]
        ]);


        AgtKelas::create([
            'kelas_id' => $kelas_id,
            'siswa_id' => $request->siswa_id,
        ]);

        return response()->json(['success' => true, 'message' => 'Siswa berhasil ditambahkan']);
    }

    // Show Detail AJAX
    public function show($id)
    {
        $agt = AgtKelas::with('siswa')->findOrFail($id);
        return response()->json(['siswa' => $agt->siswa]);
    }

    // Delete AJAX
    public function destroy($id)
    {
        $agt = AgtKelas::findOrFail($id);
        $agt->delete();

        return response()->json(['success' => true, 'message' => 'Siswa berhasil dihapus']);
    }
}
