<?php

namespace App\Http\Utils;

use App\Models\Setting;
use Illuminate\Database\QueryException;

class SettingsData {
    public static function get()
    {
        try {
            $data = [
                'semester' => Setting::where('name', 'semester')->first(),
                'upload' => Setting::where('name', 'upload')->first(),

                'kepala_lab' => Setting::where('name', 'kepala_lab')->first(),
                'asisten1' => Setting::where('name', 'asisten1')->first(),
                'asisten2' => Setting::where('name', 'asisten2')->first(),
            ];
        } catch (QueryException $e) {
            $data = [];
        }

        return $data;
    }
}
