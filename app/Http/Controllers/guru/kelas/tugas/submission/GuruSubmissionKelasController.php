<?php

namespace App\Http\Controllers\guru\kelas\tugas\submission;

use App\Http\Controllers\Controller;
use App\Models\Pengumpulan;
use App\Models\Tugas;
use Illuminate\Http\Request;

class GuruSubmissionKelasController extends Controller
{
    public function index($tugas_id)
    {
        $decryptedTugasId = decrypt($tugas_id);

        $tugas = Tugas::findOrFail($decryptedTugasId);

        return view('guru.kelas.tugas.submission.index', [
            'tugas' => $tugas,
            'tugas_id' => $decryptedTugasId,
            'type_menu' => 'guru.kelas'
        ]);
    }

    // Data AJAX
    public function data(Request $request, $tugas_id)
    {
        $perPage = 10;
        $query = Pengumpulan::with(['anggotaKelas.siswa'])
            ->where('tugas_id', $tugas_id);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('anggotaKelas.siswa', function($q) use ($search){
                $q->where('nama', 'like', "%{$search}%");
            });
        }

        $list = $query->orderBy('id','desc')->paginate($perPage);

        return response()->json([
            'data' => $list->items(),
            'pagination' => (string) $list->links('pagination::bootstrap-4')
        ]);
    }
}
