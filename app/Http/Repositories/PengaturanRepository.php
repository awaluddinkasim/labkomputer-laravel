<?php

namespace App\Http\Repositories;

use App\Http\Utils\ResetData;
use App\Models\Setting;

class PengaturanRepository {
    protected $pengaturan;

    public function __construct(Setting $pengaturan) {
        $this->pengaturan = $pengaturan;
    }

    public function getSemester() {
        return $this->pengaturan::where('name', 'semester')->first();
    }

    public function getUpload() {
        return $this->pengaturan::where('name', 'upload')->first();
    }

    public function save($data) {
        foreach ($data->keys() as $key) {
            if ($key != "_token") {
                $pengaturan = $this->pengaturan::where('name', $key)->first();
                if ($key == "semester" && $pengaturan->value != $data->$key) {
                    ResetData::praktikum();
                }
                if ($pengaturan) {
                    $pengaturan->value = $data->$key;
                    $pengaturan->update();
                } else {
                    $setting = new $this->pengaturan();
                    $setting->name = $key;
                    $setting->value = $data->$key;
                    $setting->save();
                }
            }
        }

        return [
            'status' => 'settings-saved',
            'message' => 'Pengaturan tersimpan'
        ];
    }
}
