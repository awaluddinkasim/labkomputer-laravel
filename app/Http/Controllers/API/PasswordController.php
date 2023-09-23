<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function validatePassword(Request $request)
    {
        if (Hash::check($request->password, $request->user()->password)) {
            return response()->json([
                'message' => 'berhasil'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Password yang kamu masukkan salah.'
            ], 401);
        }
    }

    public function updatePassword(Request $request)
    {
        $mhs = User::find($request->user()->id);
        $mhs->password = bcrypt($request->password);
        $mhs->update();

        return response()->json([
            'message' => 'berhasil'
        ], 200);
    }
}
