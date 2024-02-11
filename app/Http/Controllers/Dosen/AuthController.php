<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login-dosen');
    }

    public function login(Request $request)
    {
        $remember = $request->remember ? true : false;

        $credentials = [
            'nidn' => $request->nidn,
            'password' => $request->password
        ];

        if (Auth::guard('dosen')->attempt($credentials, $remember)) {
            return redirect()->route('dosen.dashboard');
        }
        return redirect()->back()->with('failed', 'NIDN atau Password salah!');
    }

    public function logout()
    {
        Auth::guard('dosen')->logout();

        return redirect()->route('dosen.login');
    }
}
