<?php

namespace App\Http\Repositories;

use App\Models\DataPraktikan;
use App\Models\Rejected;
use App\Models\User;
use Illuminate\Support\Facades\File;

class MahasiswaRepository
{
    protected $mahasiswa;
    protected $rejected;
    protected $dataPraktikan;

    public function __construct(User $mahasiswa, Rejected $rejected, DataPraktikan $dataPraktikan)
    {
        $this->mahasiswa = $mahasiswa;
        $this->rejected = $rejected;
        $this->dataPraktikan = $dataPraktikan;
    }

    public function get($except) {
        if ($except) {
            return $this->mahasiswa::whereNot('id', auth()->user()->id)->orderBy('active')->orderBy('nim')->get();
        }
        return $this->mahasiswa::orderBy('active')->orderBy('nim')->get();
    }

    public function getActive() {
        return $this->mahasiswa::where('active', '1')->get();
    }

    public function getById($id)
    {
        return $this->mahasiswa->find($id);
    }

    public function verifikasi($id)
    {
        $mhs = $this->mahasiswa::find($id);
        $mhs->active = '1';

        $mhs->update();

        return [
            'status' => 'success',
            'message' => 'Mahasiswa berhasil diverifikasi'
        ];
    }


    public function tolak($id)
    {
        $mhs = $this->mahasiswa::find($id);
        if ($mhs->foto != 'default.png') {
            File::delete(public_path('f/avatar/' . $mhs->foto));
        }

        $rejected = new $this->rejected();
        $rejected->nim = $mhs->nim;
        $rejected->save();

        $mhs->delete();

        return [
            'status' => 'success',
            'message' => 'Mahasiswa berhasil ditolak'
        ];
    }

    public function update($data, $id, $isAdmin)
    {
        $mhs = $this->mahasiswa->find($id);
        $mhs->nama = $data->nama;
        $mhs->no_hp = $data->no_hp;
        if ($isAdmin) {
            $mhs->id_prodi = $data->prodi;
            $mhs->level = $data->level;
        }
        if ($data->password) {
            $mhs->password = bcrypt($data->password);
        }
        $mhs->update();

        return [
            'status' => 'success',
            'message' => 'Akun berhasil diupdate'
        ];
    }

    public function destroy($id)
    {
        $mhs = $this->mahasiswa->find($id);
        $mhs->tokens()->delete();
        $dataPraktikan = $this->dataPraktikan->where('id_user', $mhs->id)->get();
        foreach ($dataPraktikan as $praktikan) {
            if ($praktikan->slip) {
                File::delete(
                    public_path(
                        'f/slip/' . $praktikan->praktikum->prodi->nama . '/' . $praktikan->praktikum->nama . '/' . $praktikan->slip->slip
                    )
                );
            }
        }

        if ($mhs->foto != 'default.png') {
            File::delete(public_path('f/avatar/' . $mhs->foto));
        }
        $mhs->delete();

        return [
            'status' => 'success',
            'message' => 'Akun berhasil dihapus',
        ];
    }
}
