<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginBackend()
    {
        return view('backend.v_login.login', [
            'judul' => 'Login',
        ]);
    }

    public function authenticateBackend(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {

            // Hanya Admin (0) dan Super Admin (1) yang boleh masuk
            if (!in_array(Auth::user()->role, [0, 1])) {
                Auth::logout();

                return back()->with(
                    'error',
                    'Akun ini tidak memiliki akses ke halaman administrator.'
                );
            }

            // Periksa status akun
            if (Auth::user()->status == 0) {
                Auth::logout();

                return back()->with(
                    'error',
                    'User belum aktif'
                );
            }

            $request->session()->regenerate();

            return redirect()->intended(
                route('backend.beranda')
            );
        }

        return back()->with('error', 'Login Gagal');
    }

    public function logoutBackend()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect(route('backend.login'));
    }
}
