<?php

namespace App\Http\Controllers\siswa\mapel\tugas;

use App\Http\Controllers\Controller;
use App\Models\Pengumpulan;
use App\Models\Siswa;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SiswaTugasKelasController extends Controller
{
    public function index($kelas_mapel_id){
        $decryptedKelasMapelId =  decrypt($kelas_mapel_id);

        $dataTugas = Tugas::where('kelas_mapel_id', $decryptedKelasMapelId)->get();
        
        return view('siswa.mapel.tugas.index',[
            'dataTugas' => $dataTugas,
            'type_menu'=>''
        ]);
    }

    public function detail($id){
        $decryptedTugasId =  decrypt($id);
        $tugas = Tugas::find($decryptedTugasId);

        $siswa = Siswa::where('nis', Auth::user()->username)->first();
        $anggotaKelasId = $siswa->id;
        
        $pengumpulan = Pengumpulan::where('tugas_id', $tugas->id)->where('agt_kelas_id', $anggotaKelasId)->first();
        
        return view('siswa.mapel.tugas.detail',[
            'pengumpulan' =>$pengumpulan,
            'tugas' => $tugas,
            'type_menu'=>''
        ]);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'tugas_id' => 'required|exists:tugas,id',
            'des' => 'nullable|string',
            'file' => 'required|file|max:10240|mimes:pdf,doc,docx,ppt,pptx,zip,rar',
        ]);

        $file = $request->file('file');
        $fileName = time().'_'.Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$file->getClientOriginalExtension();
        
        $siswa = Siswa::where('nis', Auth::user()->username)->first();
        $anggotaKelasId = $siswa->id;
        
        $pengumpulan = Pengumpulan::where('tugas_id', $request->tugas_id)->where('agt_kelas_id', $anggotaKelasId)->first();
        if($pengumpulan){
            $pengumpulan->des = $request->des;
            $pengumpulan->file = $fileName;
            $pengumpulan->status = $request->batas ? 'Terkirim' : 'Terlambat';
            $pengumpulan->save();
            Storage::disk('public')->delete('submission/' . $pengumpulan->file);
        }else{
            $pengumpulan = Pengumpulan::create([
                'tugas_id' => $request->tugas_id,
                'agt_kelas_id' => $anggotaKelasId,
                'des' => $request->des,
                'file' => $fileName,
                'status' => now() <= $request->batas ? 'Terkirim' : 'Terlambat',
            ]);
        }
        
        $file->storeAs('submission', $fileName, 'public');

        return response()->json([
            'success' => true,
            'message' => 'Tugas berhasil dikumpulkan!',
            'submission' => $pengumpulan
        ]);
    }

    public function submission($tugas_id)
    {
        $siswa = Siswa::where('nis', Auth::user()->username)->first();
        $anggotaKelasId = $siswa->id;
        $pengumpulan = Pengumpulan::where('tugas_id', $tugas_id)
                        ->where('agt_kelas_id', $anggotaKelasId)
                        ->first();

        return response()->json($pengumpulan);
    }
}
