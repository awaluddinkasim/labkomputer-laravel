<?php

namespace App\Http\Repositories;

use App\Models\Fakultas;
use Illuminate\Support\Facades\File;

class FakultasRepository
{
    protected $fakultas;

    public function __construct(Fakultas $fakultas)
    {
        $this->fakultas = $fakultas;
    }

    public function get()
    {
        return $this->fakultas::orderBy('nama')->get();
    }

    public function getById($id)
    {
        return $this->fakultas::find($id);
    }

    public function getWithProdi()
    {
        return $this->fakultas->has('prodi')->orderBy('nama')->get();
    }

    public function save($data)
    {
        $fak = new $this->fakultas();
        $fak->nama = $data->fakultas;
        $fak->save();

        return [
            'status' => 'success',
            'message' => 'Fakultas berhasil ditambah'
        ];
    }

    public function update($data)
    {
        $fak = $this->fakultas::find($data->id);
        $fak->nama = $data->fakultas;
        $fak->update();

        return [
            'status' => 'success',
            'message' => 'Fakultas berhasil diupdate'
        ];
    }

    public function destroy($id)
    {
        $fakultas = $this->fakultas::find($id);
        foreach ($fakultas->mahasiswa as $mahasiswa) {
            $mahasiswa->tokens()->delete();
            if ($mahasiswa->foto != 'default.png') {
                File::delete(public_path('f/avatar/' . $mahasiswa->foto));
            }
        }
        foreach ($fakultas->prodi as $prodi) {
            File::deleteDirectory(public_path('f/slip/' . $prodi->nama));
        }
        $fakultas->delete();

        return [
            'status' => 'success',
            'message' => 'Fakultas berhasil dihapus'
        ];
    }
}
