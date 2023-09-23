<?php

namespace App\Http\Controllers\API;

use App\Models\Setting;
use App\Models\Praktikum;
use Illuminate\Http\Request;
use App\Models\DataPraktikan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class PraktikumController extends Controller
{
    public function daftarPraktikum(Request $request, $jenis = null)
    {
        if (!$jenis) {
            $data = [
                'daftarPraktikum' => Praktikum::where('id_prodi', $request->user()->id_prodi)->get()
            ];
        } else {
            if ($jenis == "mahasiswa") {
                $data = [
                    'daftarPraktikum' => DataPraktikan::where('id_user', $request->user()->id)->get()->sortBy(['praktikum.semester', 'praktikum.nama'])
                ];
            } elseif ($jenis == "semester") {
                $semester = Setting::where('name', 'semester')->first()->value;
                $data = [
                    'daftarPraktikum' => Praktikum::has('pengampu')->where('id_prodi', $request->user()->id_prodi)->where('kategori', $semester)->get()
                ];
            } else {
                $data = [];
            }
        }

        return response()->json($data, 200);
    }

    public function tambahPraktikum(Request $request)
    {
        $check = DataPraktikan::where('id_user', $request->user()->id)->where('id_praktikum', $request->praktikum)->first();
        if (!$check) {
            $data = new DataPraktikan();
            $data->id_user = $request->user()->id;
            $data->id_praktikum = $request->praktikum;
            $data->nidn_dosen = $request->dosen;
            $data->save();
        }

        return response()->json([
            'daftarPraktikum' => DataPraktikan::where('id_user', $request->user()->id)->get()->sortBy(['praktikum.semester', 'praktikum.nama'])
        ], 200);
    }

    public function hapusPraktikum(Request $request)
    {
        $data = DataPraktikan::find($request->id);
        if ($data->slip) {
            File::delete(public_path('f/slip/'.$data->praktikum->prodi->nama.'/'.$data->praktikum->nama.'/'.$data->slip->slip));
        }
        $data->delete();

        return response()->json([
            'daftarPraktikum' => DataPraktikan::where('id_user', $request->user()->id)->get()->sortBy(['praktikum.semester', 'praktikum.nama'])
        ], 200);
    }
}
