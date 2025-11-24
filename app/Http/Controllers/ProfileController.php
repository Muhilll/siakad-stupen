<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        $username = Auth::user()->username;
        if(Auth::user()->role == 'guru'){
           $profile = Guru::where('nip', $username)->first();
        } 

        if(Auth::user()->role == 'siswa'){
           $profile = Siswa::where('nis', $username)->first();
        }

        if(Auth::user()->role == 'admin'){
           $profile = User::where('username', $username)->first();
        }
        return view('profile.index', [
            'profile' => $profile,
            'type_menu' => 'guru'
        ]);
    }
    
    public function editPassword(Request $request){
        $request->validate([
            'user_id' => 'required',
            'password' => 'required'
        ]);

        $user = User::find($request->user_id);

        $user->password = bcrypt($request->password);
        $user->save();

        return back()->with([
            'success' => 'password',
            'message' => 'Password berhasil diperbarui!'
        ]);
    }

}
