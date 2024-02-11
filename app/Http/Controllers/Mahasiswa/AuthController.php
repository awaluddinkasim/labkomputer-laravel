<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login-mahasiswa');
    }

    public function login(Request $request)
    {
        $remember = $request->remember ? true : false;

        $credentials = [
            'nim' => $request->nim,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials, $remember)) {
            if (Auth::user()->active == '1') {
                return redirect()->route('dashboard');
            } else {
                Auth::logout();

                return redirect()->back()->with('failed', 'Akun belum diverifikasi');
            }
        }
        return redirect()->back()->with('failed', 'NIM atau Password salah!');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
