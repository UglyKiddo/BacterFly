<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;

class AuthController extends Controller
{

    public function showRegisterForm()
    {
    return view('auth.register');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $email = filter_var($request->input('email'), FILTER_SANITIZE_EMAIL);
        $password = $request->input('password');

        $user = DB::table('users')->where('email', $email)->first();

        if ($user && password_verify($password, $user->password) && $user->is_verified == 1) {
            Session::regenerate();
            Session::put('user_email', $email);
            Session::put('logged_in', true);
            Session::put('id', $user->id);
            Session::put('division', $user->division ?? '-');

            $division = strtolower(trim($user->division));
            switch ($division) {
                case 'laboratorium':
                    return redirect('lab_dashboard.php');
                case 'produksi':
                    return redirect('pro_dashboard.php');
                case 'manager':
                    return redirect('man_dashboard.php');
                default:
                    return redirect('index.php');
            }
        } else {
            return redirect()->back()->with('pesan', 'Email atau kata sandi salah, atau akun belum diverifikasi.');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }

    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->email;

        $user = DB::table('users')->where('email', $email)->first();
        if ($user) {
            return redirect()->back()->with('pesan', 'Email sudah terdaftar!');
        }

        $kode = str_pad(rand(0, 999999), 6, "0", STR_PAD_LEFT);
        session(['email' => $email, 'verification_code' => $kode]);

        Mail::to($email)->send(new VerificationCodeMail($kode));

        return redirect()->back()->with('pesan', 'Kode verifikasi telah dikirim ke email Anda!');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'code' => 'required',
            'division' => 'required'
        ]);

        if ($request->input('code') !== session('verification_code')) {
            return redirect()->back()->with('pesan', 'Kode verifikasi salah!');
        }

        $email = filter_var($request->input('email'), FILTER_SANITIZE_EMAIL);
        $password = password_hash($request->input('password'), PASSWORD_DEFAULT);
        $division = $request->input('division');

        DB::table('users')->insert([
            'email' => $email,
            'password' => $password,
            'verification_code' => session('verification_code'),
            'is_verified' => 1,
            'division' => $division
        ]);

    session()->forget(['email', 'verification_code']);
    session(['user_email' => $email, 'logged_in' => true, 'division' => $division]);

    return match (strtolower($division)) {
        'laboratorium' => redirect('lab_dashboard'),
        'produksi' => redirect('pro_dashboard'),
        'manager' => redirect('man_dashboard'),
        default => redirect('login'),
    };
}
}