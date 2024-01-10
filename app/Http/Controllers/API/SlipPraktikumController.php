<?php

namespace App\Http\Controllers\API;

use App\Models\Slip;
use Illuminate\Http\Request;
use App\Models\DataPraktikan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class SlipPraktikumController extends Controller
{
    public function get(Request $request)
    {
        if ($request->has('praktikum')) {
            $data = DataPraktikan::where('id_praktikum', $request->praktikum)->where('id_user', $request->user()->id)->first();

            if ($data->slip) {
                return response()->json([
                    'slip' => $data->slip
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Belum upload slip',
                ], 200);
            }
        } else {
            return response()->json([
                'message' => 'Terjadi kesalahan',
            ], 400);
        }
    }

    public function store(Request $request)
    {
        $data = DataPraktikan::find($request->id);

        $file = $request->file('slip');
        $extension = $file->extension();
        $filename = $data->praktikan->nim . '-' . time() . '.' . $extension;

        $slip = Slip::where('id_data', $data->id)->first();
        if ($slip) {
            File::delete(public_path('f/slip/' . $data->praktikum->prodi->nama . '/' . $data->praktikum->nama . '/' . $slip->slip));
            $slip->delete();
        }

        $slip = new Slip();
        $slip->id_data = $data->id;
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
