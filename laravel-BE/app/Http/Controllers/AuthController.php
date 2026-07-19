<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showUserLogin()
    {
        return view('login-member');
    }

    public function showAdminLogin()
    {
        return view('login-admin');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            $user = Auth::user();
            session()->forget('url.intended');
            if ($user->role === 'admin') {
                return redirect()->intended('/admin');
            }elseif ($user->role === 'member' && $user->status !== 'active') {
                Auth::logout();
                return redirect()->back()->with('error', 'Akun Anda belum aktif. Silakan hubungi admin.');
            } elseif ($user->role === 'member') {
                return redirect()->intended('/member');
            } else {
                Auth::logout();
                return redirect()->back()->with('error', 'Peran pengguna tidak valid.');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
