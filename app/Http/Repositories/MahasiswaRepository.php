<?php

namespace App\Http\Repositories;

use App\Events\UserRegistered;
use App\Models\User;
use App\Models\Rejected;
use App\Models\DataPraktikan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

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

    public function get($except)
    {
        if ($except) {
            return $this->mahasiswa::whereNot('id', auth()->user()->id)->orderBy('active')->orderBy('nim')->get();
        }
        return $this->mahasiswa::orderBy('active')->orderBy('nim')->get();
    }

    public function getActive()
    {
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

    public function store($data)
    {
        // if ($data->has('foto') && $data->foto) {
        //     $foto = $data->file('foto');
        //     $filename = 'mhs-' . uniqid() . '.' . $foto->extension();
        // } else {
        //     return [
        //         'status' => 'failed',
        //         'message' => 'Foto tidak ditemukan'
        //     ];
        // }

        $mhs = new $this->mahasiswa();
        $mhs->nim = $data->nim;
        $mhs->nama = $data->nama;
        $mhs->no_hp = substr($data->no_hp, 0, 2) == "08" ? $data->no_hp : "0" . $data->no_hp;
        $mhs->id_prodi = $data->prodi;
        $mhs->password = Hash::make($data->password);
        // if (isset($foto)) {
        //     if ($mhs->foto != "default.png") {
        //         File::delete(public_path('f/avatar/' . $mhs->foto));
        //     }
        //     $mhs->foto = $filename;
        //     $foto->move(public_path('f/avatar'), $filename);
        // } else {
        $mhs->foto = 'default.png';
        // }
        $mhs->save();

        $unverifiedUser = $this->mahasiswa::where('active', '0')->get()->count();
        event(new UserRegistered($unverifiedUser));

        return [
            'status' => 'success',
            'message' => 'Berhasil mendaftar'
        ];
    }

    public function update($data, $id, $isAdmin)
    {
        if ($data->has('foto') && $data->foto) {
            $foto = $data->file('foto');
            $filename = 'mhs-' . uniqid() . '.' . $foto->extension();
        }

        $mhs = $this->mahasiswa->find($id);
        $mhs->nama = $data->nama;
        $mhs->no_hp = $data->no_hp;
        if ($isAdmin) {
            $mhs->id_prodi = $data->prodi;
            $mhs->level = $data->level;
        }
        if ($data->has('password') && $data->password) {
            $mhs->password = Hash::make($data->password);
        }
        if (isset($foto)) {
            if ($mhs->foto != "default.png") {
                File::delete(public_path('f/avatar/' . $mhs->foto));
            }
            $mhs->foto = $filename;
            $foto->move(public_path('f/avatar'), $filename);
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

    public function updatePassword($id, $data)
    {
        $user = User::find($id);
        if (Hash::check($data->old_password, $user->password)) {
            $user->password = Hash::make($data->new_password);
            $user->update();

            return [
                'status' => 'success',
                'message' => 'Ganti password berhasil'
            ];
        }
        return [
            'status' => 'failed',
            'message' => 'Password salah'
        ];
    }
}
