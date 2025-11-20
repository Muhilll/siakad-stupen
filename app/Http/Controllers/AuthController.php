<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\MapelGuru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        $mapels = Mapel::all();
        return view('auth.login', compact('mapels'));
    }

    public function loginProcess(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->nis)->first();

        if (!$user) {
            return back()->with('error', 'NIS tidak ditemukan!');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password tidak sesuai!');
        }


        if ($user->role === 'admin') {
            Auth::login($user);

            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'guru') {
            $guru = Guru::where('nip', $user->username)->first();
            $mapelGuru = MapelGuru::where('mapel_id',$request->mapel_id)->where('guru_id', $guru->id)->get();
            
            if(!$mapelGuru){
                return back()->with('Error', 'Guru dan matapelajaran tidak valid');
            }

            $user->mapel_id = $request->mapel_id;
            $user->save();

            Auth::login($user);

            return redirect()->route('guru.dashboard');
        }

        if ($user->role === 'siswa') {
            Auth::login($user);

            return redirect()->route('siswa.dashboard');
        }

        return back()->with('error', 'Role tidak dikenali!');
    }


    public function logout()
    {
        if(Auth::user()->role === 'guru'){
            $user = User::find(Auth::id());
            $user->mapel_id = null;
            $user->save();
        }

        Auth::logout();

        return redirect()->route('login');
    }
}
