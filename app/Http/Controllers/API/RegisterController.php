<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Rejected;
use Illuminate\Http\Request;
use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $foto = $request->file('foto');
        $filename = 'mhs-'.uniqid().'.'.$foto->extension();

        try {
            $mhs = new User();
            $mhs->nim = $request->nim;
            $mhs->nama = $request->nama;
            $mhs->no_hp = "0".$request->no_hp;
            $mhs->password = Hash::make($request->password);
            $mhs->foto = $filename;
            $mhs->id_prodi = $request->id_prodi;
            $mhs->save();

            $rejected = Rejected::where('nim', $mhs->nim)->first();
            if ($rejected) {
                $rejected->delete();
            }

            $foto->move(public_path('f/avatar'), $filename);

            $unverifiedUser = User::where('active', '0')->get()->count();
            event(new UserRegistered($unverifiedUser));

            return response()->json([
                'message' => 'Berhasil mendaftar, akun kamu sedang menunggu verifikasi dari admin'
            ], 200);
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return response()->json([
                    'message' => 'Akun dengan NIM tersebut sudah terdaftar sebelumnya'
                ], 400);
            }
            return response()->json([
                'message' => 'Daftar akun gagal'
            ], 400);
        }
    }

}
