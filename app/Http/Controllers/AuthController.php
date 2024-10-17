<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    public function loginProses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Jika login berhasil, arahkan ke dashboard berdasarkan role
            $user = Auth::user();
            if ($user->role == 1) {
                return redirect()->route('dashboard.admin');
            } elseif ($user->role == 2) {
                return redirect()->route('dashboard.pegawai');
            } elseif ($user->role == 0) {
                return redirect()->route('data-nilai.siswa');
            }
        }

        // Jika login gagal, kembali ke halaman login dengan pesan error
        return redirect()->back()->with('error', 'Username atau Password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
