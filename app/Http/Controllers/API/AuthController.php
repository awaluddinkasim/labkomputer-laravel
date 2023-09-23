<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Rejected;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Rejected::where('nim', $request->nim)->first()) {
            return response()->json([
                'message' => 'Akun kamu ditolak, silahkan daftar kembali',
                'data' => $request->all()
            ], 401);
        }
        $mahasiswa = User::where('nim', $request->nim)->first();

        if ($mahasiswa && Hash::check($request->password, $mahasiswa->password)) {
            if ($mahasiswa && $mahasiswa->active) {
                $token = $mahasiswa->createToken('auth-user')->plainTextToken;

                return response()->json([
                    'message' => 'Berhasil',
                    'token' => $token,
                    'user' => $mahasiswa
                ], 200);
            } elseif ($mahasiswa && !$mahasiswa->active) {
                return response()->json([
                    'message' => 'Akun belum terverifikasi',
                    'data' => $request->all()
                ], 401);
            }
        }

        return response()->json([
            'message' => 'NIM atau Password salah',
            'data' => $request->all()
        ], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'berhasil'
        ], 200);
    }
}
