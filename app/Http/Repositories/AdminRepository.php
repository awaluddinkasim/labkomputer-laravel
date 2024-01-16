<?php

namespace App\Http\Repositories;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminRepository
{
    protected $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function update($id, $data)
    {
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
    }
}
