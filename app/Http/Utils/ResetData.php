<?php

namespace App\Http\Utils;

use App\Models\DataPengampu;
use App\Models\DataPraktikan;
use App\Models\Praktikum;
use Illuminate\Support\Facades\File;

class ResetData {
    public static function praktikum() {
        DataPraktikan::truncate();
        DataPengampu::truncate();

        $daftarPraktikum = Praktikum::all();

        foreach ($daftarPraktikum as $praktikum) {
            File::deleteDirectory(public_path('f/slip/' . $praktikum->prodi->nama . '/' . str_replace('/', '-', $praktikum->nama)));
        }
    }
}
