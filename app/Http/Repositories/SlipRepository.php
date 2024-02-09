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

        $slip = $this->slip::where('id_data', $dp->id)->first();
        if ($slip) {
            File::delete(public_path('f/slip/' . $dp->praktikum->prodi->nama . '/' . str_replace('/', '-', $dp->praktikum->nama) . '/' . $slip->slip));
            $slip->delete();
        }

        $slip = new $this->slip();
        $slip->id_data = $dp->id;
        $slip->slip = $filename;
        $slip->nominal = str_replace('.', '', $data->nominal);
        $slip->tgl_slip = $data->tgl;
        $slip->save();

        $file->move(public_path('f/slip/' . $dp->praktikum->prodi->nama . '/' . str_replace('/', '-', $dp->praktikum->nama) . '/'), $filename);

        return [
            'status' => 'success',
            'message' => 'Upload berhasil'
        ];
    }

    public function delete($data)
    {
        $slip = $this->slip::find($data->id);
        if ($slip) {
            File::delete(public_path('f/slip/' . $slip->dataPraktikan->praktikum->prodi->nama . '/' . str_replace('/', '-', $slip->dataPraktikan->praktikum->nama) . '/' . $slip->slip));
            $slip->delete();
        }
        $slip->delete();

        return [
            'status' => 'success',
            'message' => 'Slip berhasil dihapus'
        ];
    }
}
