<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
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

        Auth::login($user, $request->has('remember'));

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'guru') {
            return redirect()->route('guru.dashboard');
        }

        if ($user->role === 'siswa') {
            return redirect()->route('siswa.dashboard');
        }

        return back()->with('error', 'Role tidak dikenali!');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
