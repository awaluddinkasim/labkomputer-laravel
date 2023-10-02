<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function updatePassword(Request $request)
    {
        if (Hash::check($request->old_password, $request->user()->password)) {
            $mhs = User::find($request->user()->id);
            $mhs->password = bcrypt($request->new_password);
            $mhs->update();

            return response()->json([
                'message' => 'Password berhasil diganti'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Password Anda masukkan salah.'
            ], 401);
        }
    }
}
