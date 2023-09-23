<?php

namespace App\Http\Repositories;

use App\Models\Dosen;
use App\Models\DataPengampu;
use App\Models\DataPraktikan;
use Illuminate\Support\Facades\File;

class DosenRepository
{
    protected $dosen;
    protected $dataPengampu;

    public function __construct(Dosen $dosen, DataPengampu $dataPengampu)
    {
        $this->dosen = $dosen;
        $this->dataPengampu = $dataPengampu;
    }

    public function get()
    {
        return $this->dosen->orderBy('nama')->get();
    }

    public function getById($id)
    {
        return $this->dosen->find($id);
    }

    public function store($data)
    {
        $dosen = new Dosen();
        $dosen->nidn = $data->nidn;
        $dosen->nama = $data->nama;
        $dosen->password = bcrypt($data->password);
        $dosen->save();

        return [
            'status' => 'success',
            'message' => 'Berhasil menambah akun',
        ];
    }

    public function update($data, $id)
    {
        $dosen = $this->getById($id);

        $nidn = $dosen->nidn;
        if ($nidn != $data->nidn) {
            DataPraktikan::where('nidn_dosen', $nidn)->update([
                'nidn_dosen' => $data->nidn,
                'updated_at' => now()
            ]);
        }
        $dosen->nidn = $data->nidn;
        $dosen->nama = $data->nama;
        if ($data->password) {
            $dosen->password = bcrypt($data->password);
        }
        $dosen->update();

        DataPraktikan::where('nidn_dosen', $dosen->nidn)->update([
            'nidn_dosen' => $data->nidn,
            'updated_at' => now()
        ]);

        return [
            'status' => 'success',
            'message' => 'Akun berhasil diupdate',
        ];
    }

    public function destroy($id)
    {
        $dosen = Dosen::find($id);
        if ($dosen->foto != 'default.png') {
            File::delete(public_path('f/avatar/' . $dosen->foto));
        }
        $dosen->delete();

        return [
            'status' => 'success',
            'message' => 'Akun berhasil dihapus',
        ];
    }

    public function tambahPraktikum($data, $id)
    {
        $pengampu = new $this->dataPengampu();
        $pengampu->id_dosen = $id;
        $pengampu->id_praktikum = $data->praktikum;
        $pengampu->save();

        return [
            'status' => 'success',
            'message' => 'Praktikum berhasil ditambah',
        ];
    }

    public function hapusPraktikum($id)
    {
        $this->dataPengampu->find($id)->delete();

        return [
            'status' => 'success',
            'message' => 'Praktikum berhasil dihapus',
        ];
    }
}
