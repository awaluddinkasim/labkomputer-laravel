<?php

namespace App\Http\Repositories;

use App\Models\DataPraktikan;
use Illuminate\Support\Facades\File;

class DataPraktikanRepository
{
    protected $dataPraktikan;

    public function __construct(DataPraktikan $dataPraktikan)
    {
        $this->dataPraktikan = $dataPraktikan;
    }

    public function get() {
        return $this->dataPraktikan::distinct()->get(['id_praktikum', 'nidn_dosen'])->sortBy('praktikum.nama');
    }

    public function getById($id)
    {
        return $this->dataPraktikan::find($id);
    }

    public function store($id, $data)
    {
        $dataPraktikan = new $this->dataPraktikan();
        $dataPraktikan->id_user = $id;
        $dataPraktikan->id_praktikum = $data->praktikum;
        $dataPraktikan->nidn_dosen = $data->dosen;
        $dataPraktikan->save();

        return [
            'status' => 'success',
            'message' => 'Tambah praktikum berhasil'
        ];
    }

    public function destroy($id)
    {
        $data = $this->dataPraktikan::find($id);
        if ($data->slip) {
            File::delete(public_path('f/slip/'.$data->praktikum->prodi->nama.'/'.$data->praktikum->nama.'/'.$data->slip->slip));
        }
        $data->delete();

        return [
            'status' => 'success',
            'message' => 'Tambah praktikum berhasil'
        ];
    }
}
