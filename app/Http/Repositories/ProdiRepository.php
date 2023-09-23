<?php

namespace App\Http\Repositories;

use App\Models\Prodi;
use Illuminate\Support\Facades\File;

class ProdiRepository
{
    protected $prodi;

    public function __construct(Prodi $prodi)
    {
        $this->prodi = $prodi;
    }

    public function get()
    {
        return $this->prodi::all()->sortBy(['fakultas.nama', 'nama']);
    }

    public function getById($id)
    {
        return $this->prodi::find($id);
    }

    public function save($data)
    {
        $prodi = new $this->prodi();
        $prodi->id_fakultas = $data->fakultas;
        $prodi->nama = $data->prodi;
        $prodi->save();

        $path = public_path('f/slip/' . $prodi->nama);

        if(!File::exists($path)) {
            File::makeDirectory($path);
        }

        return [
            'status' => 'success',
            'message' => 'Prodi berhasil ditambah'
        ];
    }

    public function update($data)
    {
        $prodi = $this->prodi::find($data->id);
        $oldname = $prodi->nama;
        $prodi->id_fakultas = $data->fakultas;
        $prodi->nama = $data->prodi;
        $prodi->update();

        rename(public_path('f/slip/' . str_replace('/', '-', $oldname)), public_path('f/slip/' . str_replace('/', '-', $prodi->nama)));

        return [
            'status' => 'success',
            'message' => 'Prodi berhasil diupdate'
        ];
    }

    public function destroy($id)
    {
        $prodi = $this->prodi::find($id);
        foreach ($prodi->mahasiswa as $mahasiswa) {
            $mahasiswa->tokens()->delete();
            if ($mahasiswa->foto != 'default.png') {
                File::delete(public_path('f/avatar/' . $mahasiswa->foto));
            }
        }
        File::deleteDirectory(public_path('f/slip/' . $prodi->nama));

        $prodi->delete();

        return [
            'status' => 'success',
            'message' => 'Prodi berhasil dihapus'
        ];
    }
}
