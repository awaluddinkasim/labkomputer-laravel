<?php

namespace App\Http\Controllers\API;

use App\Models\Setting;
use App\Models\Praktikum;
use Illuminate\Http\Request;
use App\Models\DataPraktikan;
use App\Http\Controllers\Controller;
use App\Http\Utils\SettingsData;
use Illuminate\Support\Facades\File;

class PraktikumController extends Controller
{
    public function get(Request $request)
    {
        $data = [
            'message' => 'berhasil',
            'daftarPraktikumMahasiswa' => DataPraktikan::where('id_user', $request->user()->id)->get()->sortBy(['praktikum.semester', 'praktikum.nama']),
            'daftarPraktikum' => Praktikum::has('pengampu')->where('id_prodi', $request->user()->id_prodi)->where('kategori', SettingsData::get()['semester']['value'])->orderBy('semester')->get(),
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $check = DataPraktikan::where('id_user', $request->user()->id)->where('id_praktikum', $request->praktikum)->first();
        if (!$check) {
            $data = new DataPraktikan();
            $data->id_user = $request->user()->id;
            $data->id_praktikum = $request->praktikum;
            $data->nidn_dosen = $request->dosen;
            $data->save();

            return response()->json([
                'message' => 'berhasil',
                'daftarPraktikum' => DataPraktikan::where('id_user', $request->user()->id)->get()->sortBy(['praktikum.semester', 'praktikum.nama'])
            ], 200);
        }

        return response()->json([
            'message' => 'Praktikum sudah ada',
        ], 409);
    }

    public function delete(Request $request)
    {
        $data = DataPraktikan::find($request->id);
        if ($data->slip) {
            File::delete(public_path('f/slip/' . $data->praktikum->prodi->nama . '/' . $data->praktikum->nama . '/' . $data->slip->slip));
        }
        $data->delete();

        return response()->json([
            'message' => 'berhasil',
            'daftarPraktikum' => DataPraktikan::where('id_user', $request->user()->id)->get()->sortBy(['praktikum.semester', 'praktikum.nama'])
        ], 200);
    }
}
