<?php

namespace App\Http\Utils;

use App\Models\DataPengampu;
use App\Models\DataPraktikan;
use App\Models\Praktikum;
use App\Models\Slip;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class ResetData {
    public static function praktikum() {
        Schema::disableForeignKeyConstraints();
        Slip::truncate();
        DataPraktikan::truncate();
        DataPengampu::truncate();
        Schema::enableForeignKeyConstraints();

        $daftarPraktikum = Praktikum::all();

        foreach ($daftarPraktikum as $praktikum) {
            File::deleteDirectory(public_path('f/slip/' . $praktikum->prodi->nama . '/' . str_replace('/', '-', $praktikum->nama)));
        }
    }
}
