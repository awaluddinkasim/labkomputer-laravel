<?php

namespace App\Http\Controllers\API;

use App\Models\Slip;
use Illuminate\Http\Request;
use App\Models\DataPraktikan;
use App\Http\Controllers\Controller;

class UploadBerkasController extends Controller
{
    public function slip(Request $request)
    {
        $data = DataPraktikan::find($request->id);

        $file = $request->file('slip');
        $extension = $file->getClientOriginalExtension();
        $filename = $data->praktikan->nim.'-'.time().'.'.$extension;


        $imageSize = getimagesize($file);
        if ($imageSize[0] < $imageSize[1]) {
            if ($extension == "jpeg" || $extension == "jpg") {
                $source = imagecreatefromjpeg($file);
                $rotate = imagerotate($source, 90, 0);
                imagejpeg($rotate, public_path('f/slip/'.$data->praktikum->prodi->nama.'/'.$data->praktikum->nama.'/'.$filename));
            } elseif ($extension == "png") {
                $source = imagecreatefrompng($file);
                $rotate = imagerotate($source, 90, 0);
                imagepng($rotate, public_path('f/slip/'.$data->praktikum->prodi->nama.'/'.$data->praktikum->nama.'/'.$filename));
            } else {
                return response()->json([
                    'message' => 'Format tidak didukung',
                ], 400);
            }
        } else {
            $file->move(public_path('f/slip/'.$data->praktikum->prodi->nama.'/'.$data->praktikum->nama.'/'), $filename);
        }

        $slip = new Slip();
        $slip->id_data = $request->id;
        $slip->slip = $filename;
        $slip->nominal = $request->nominal;
        $slip->tgl_slip = $request->tgl;
        $slip->save();

        return response()->json([
            'message' => 'berhasil',
            'dimension' => 'w: '.$imageSize[0].' x '.'h: '.$imageSize[1],
            'daftarPraktikum' => DataPraktikan::where('id_user', $request->user()->id)->get()->sortBy(['praktikum.semester', 'praktikum.nama'])
        ], 200);
    }

    public function bebasLab(Request $request)
    {

    }
}
