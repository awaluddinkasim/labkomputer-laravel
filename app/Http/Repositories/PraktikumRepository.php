<?php

namespace App\Http\Repositories;

use App\Models\Praktikum;
use Illuminate\Support\Facades\File;

class PraktikumRepository
{
    protected $praktikum;

    public function __construct(Praktikum $praktikum)
    {
        $this->praktikum = $praktikum;
    }

    public function get()
    {
        return $this->praktikum::all()->sortBy(['semester', 'prodi.nama', 'nama']);
    }

    public function getById($id)
    {
        return $this->praktikum::find($id);
    }

    public function getWithPengampu($prodi, $semester)
    {
        return $this->praktikum::has('pengampu')->where('id_prodi', $prodi)->where('kategori', $semester)->get();
    }

    public function save($data)
    {
        $prak = new $this->praktikum();
        $prak->id_prodi = $data->prodi;
        $prak->nama = $data->nama;
        $prak->semester = $data->semester;
        $prak->kategori = $data->semester % 2 == 0 ? 'genap' : 'ganjil';
        $prak->save();

        $path = public_path('f/slip/' . $prak->prodi->nama . '/' . str_replace('/', '-', $prak->nama));

        if (!File::exists($path)) {
            File::makeDirectory($path);
        }

        return [
            'status' => 'success',
            'message' => 'Praktikum berhasil ditambah'
        ];
    }

    public function update($data)
    {
        $prak = $this->praktikum::find($data->id);
        $oldname = $prak->nama;
        $prak->nama = $data->nama;
        $prak->semester = $data->semester;
        $prak->id_prodi = $data->prodi;
        $prak->kategori = $data->semester % 2 == 0 ? 'genap' : 'ganjil';
        $prak->update();

        rename(
            public_path('f/slip/' . $prak->prodi->nama . '/' . str_replace('/', '-', $oldname)),
            public_path('f/slip/' . $prak->prodi->nama . '/' . str_replace('/', '-', $prak->nama))
        );

        return [
            'status' => 'success',
            'message' => 'Praktikum berhasil diupdate'
        ];
    }

    public function destroy($id)
    {
        $prak = $this->praktikum::find($id);
        File::deleteDirectory(public_path('f/slip/' . $prak->prodi->nama . '/' . str_replace('/', '-', $prak->nama)));
        $prak->delete();

        return [
            'status' => 'success',
            'message' => 'Praktikum berhasil dihapus'
        ];
    }
}
