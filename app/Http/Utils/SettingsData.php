<?php

namespace App\Http\Utils;

use App\Models\Setting;

class SettingsData {
    public static function get()
    {
        $data = [
            'semester' => Setting::where('name', 'semester')->first(),
            'upload' => Setting::where('name', 'upload')->first(),

            'kepala_lab' => Setting::where('name', 'kepala_lab')->first(),
            'asisten1' => Setting::where('name', 'asisten1')->first(),
            'asisten2' => Setting::where('name', 'asisten2')->first(),
        ];

        return $data;
    }
}
