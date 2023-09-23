<?php

namespace App\Http\Controllers;

use App\Models\DataPengampu;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function dosen(Request $request)
    {
        $id = $request->praktikum;
        $data = [
            'daftarPengampu' => DataPengampu::where('id_praktikum', $id)->get()
        ];

        return view('mahasiswa.ajax.select-option-dosen', $data);
    }
}
