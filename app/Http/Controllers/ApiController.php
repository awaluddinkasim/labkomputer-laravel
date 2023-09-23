<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Setting;

class ApiController extends Controller
{
    public function data()
    {
        $data = [
            'upload' => Setting::where('name', 'upload')->first()->value,
            'semester' => Setting::where('name', 'semester')->first()->value,
            'daftarJurusan' => Fakultas::has('prodi')->orderBy('nama')->get()
        ];

        return response()->json($data, 200);
    }
}
