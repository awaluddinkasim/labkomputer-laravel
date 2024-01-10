<?php

namespace App\Http\Controllers\API;

use App\Models\Slip;
use Illuminate\Http\Request;
use App\Models\DataPraktikan;
use App\Http\Controllers\Controller;

class SlipPraktikumController extends Controller
{
    public function store(Request $request)
    {
        $data = DataPraktikan::find($request->id);

        $file = $request->file('slip');
        $extension = $file->extension();
        $filename = $data->praktikan->nim . '-' . time() . '.' . $extension;

        $slip = new Slip();
        $slip->id_data = $request->id;
        $slip->slip = $filename;
        $slip->nominal = $request->nominal;
        $slip->tgl_slip = $request->tgl;
        $slip->save();

        $file->move(public_path('f/slip/' . $data->praktikum->prodi->nama . '/' . $data->praktikum->nama . '/'), $filename);

        return response()->json([
            'message' => 'berhasil',
            'daftarPraktikum' => DataPraktikan::where('id_user', $request->user()->id)->get()->sortBy(['praktikum.semester', 'praktikum.nama'])
        ], 200);
    }
}
