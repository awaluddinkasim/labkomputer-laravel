<?php

namespace App\Http\Repositories;

use App\Models\DataPraktikan;
use App\Models\Slip;
use Illuminate\Support\Facades\File;

class SlipRepository
{
    protected $slip;

    public function __construct(Slip $slip)
    {
        $this->slip = $slip;
    }

    public function store($dp, $data)
    {
        $file = $data->file('slip');
        $extension = $file->extension();
        $filename = $dp->praktikan->nim . '-' . time() . '.' . $extension;

        $slip = Slip::where('id_data', $dp->id)->first();
        if ($slip) {
            File::delete(public_path('f/slip/' . $dp->praktikum->prodi->nama . '/' . $dp->praktikum->nama . '/' . $slip->slip));
            $slip->delete();
        }

        $slip = new Slip();
        $slip->id_data = $dp->id;
        $slip->slip = $filename;
        $slip->nominal = $data->nominal;
        $slip->tgl_slip = $data->tgl;
        $slip->save();

        $file->move(public_path('f/slip/' . $dp->praktikum->prodi->nama . '/' . $dp->praktikum->nama . '/'), $filename);

        return [
            'status' => 'success',
            'message' => 'Upload berhasil'
        ];
    }
}
