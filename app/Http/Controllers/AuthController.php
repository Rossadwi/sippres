<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.signin');
    }

    public function dologin(Request $request)
    {



        $user = Auth::user();
        // validasi
        $credentials = $request->validate([
            'email' => 'required|email',
            // 'username' => 'required',
            'password' => 'required'
        ]);

        if (auth()->attempt($credentials)) {
            // dd(auth()->user()->role);
            // return;

            // buat ulang session login
            $request->session()->regenerate();

            // if (auth()->user()->type === 1) {
            //     // jika user superadmin
            //     return redirect()->intended('/superadmin');
            // } else {
            //     // jika user pegawai
            //     return redirect()->intended('/pegawai');
            // }
            if (auth()->user()->role === 1) {
                // jika user admin
                return redirect()->intended('/admin');
            } else if (auth()->user()->role === 2) {
                // jika user siswa
                return redirect()->intended('/siswa');
            }
        }

        // jika email atau password salah
        // kirimkan session error
        return back()->with('error', 'email atau password salah');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }


    public function cekrole()
    {
        if (auth()->user()->role === 1) {
            // jika user admin
            return redirect()->intended('/admin');
        } else if (auth()->user()->role === 0) {
            // jika user siswa
            return redirect()->intended('/siswa');
        }
    }
}
