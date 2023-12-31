<?php

namespace App\Http\Repositories;

use App\Models\User;
use App\Models\Admin;
use App\Models\Dosen;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class ProfileRepository {
    protected $admin;
    protected $dosen;
    protected $user;

    public function __construct(Admin $admin, Dosen $dosen, User $user) {
        $this->admin = $admin;
        $this->dosen = $dosen;
        $this->user = $user;
    }

    public function updateAdmin($id, $data) {
        try {
            $admin = $this->admin::find($id);
            $admin->email = $data->email;
            $admin->nama = $data->nama;
            if ($data->password) {
                $admin->password = Hash::make($data->password);
            }
            $admin->update();

            return [
                'status' => 'success',
                'message' => 'Update profil berhasil'
            ];
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return [
                    'status' => 'failed',
                    'message' => 'Email telah terdaftar pada akun lain'
                ];
            }
        }
    }

    public function updateDosen($id, $data) {
        $dosen = $this->dosen::find($id);
        $dosen->nama = $data->nama;
        if ($data->password) {
            $dosen->password = Hash::make($data->password);
        }
        $dosen->update();

        return [
            'status' => 'success',
            'message' => 'Update profil berhasil'
        ];
    }

    public function updateMahasiswa($id, $data) {
        $foto = $data->file('foto');
        if ($foto) {
            $filename = 'mhs-'.uniqid().'.'.$foto->extension();
        }

        $mhs = $this->user::find($id);
        $mhs->nama = $data->nama;
        $mhs->id_prodi = $data->prodi;
        $mhs->no_hp = $data->hp;
        if ($foto) {
            if ($mhs->foto != "default.png") {
                File::delete(public_path('f/avatar/'.$mhs->foto));
            }
            $mhs->foto = $filename;
            $foto->move(public_path('f/avatar'), $filename);
        }
        $mhs->update();

        return [
            'status' => 'success',
            'message' => 'Update profil berhasil'
        ];
    }
}
