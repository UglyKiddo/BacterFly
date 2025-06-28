<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login menggunakan Auth
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Cek apakah akun sudah diverifikasi
            if ($user->is_verified != 1) {
                Auth::logout();
                return back()->with('pesan', 'Akun belum diverifikasi.');
            }

            // Arahkan ke dashboard sesuai divisi
            $division = strtolower(trim($user->division));

            switch ($division) {
                case 'laboratorium':
                    return redirect()->route('lab.dashboard');
                case 'produksi':
                    return redirect()->route('produksi.dashboard');
                case 'manager':
                    return redirect()->route('manager.dashboard');
                default:
                    return redirect()->route('home');
            }
        }

        // Jika gagal login
        return back()->with('pesan', 'Email atau kata sandi salah.');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}