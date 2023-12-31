<?php

namespace App\Http\Repositories;

use App\Models\BebasLab;
use Illuminate\Support\Facades\File;

class BebasLabRepository
{
    protected $bebasLab;

    public function __construct(BebasLab $bebasLab)
    {
        $this->bebasLab = $bebasLab;
    }

    public function getPending()
    {
        return $this->bebasLab->where('status', 'pending')->get();
    }

    public function getNotPending()
    {
        return $this->bebasLab->where('status', 'selesai')->orWhere('status', 'ditolak')->get();
    }

    public function getById($id)
    {
        return $this->bebasLab->find($id);
    }

    public function store($user, $data)
    {
        $path = public_path('f/bebaslab/' . $user->nim);
        $slip = $data->file('bukti-bayar');
        $slipName = 'slip-' . time() . '.' . $slip->extension();

        $berkas = $data->file('berkas');
        $berkasName = 'berkas-' . time() . '.' . $berkas->extension();

        $bebasLab = $user->bebasLab;
        if ($bebasLab) {
            $bebasLab->delete();
        }
        $bebasLab = new $this->bebasLab();
        $bebasLab->id_user = $user->id;
        $bebasLab->bukti_bayar = $slipName;
        $bebasLab->berkas = $berkasName;
        $bebasLab->status = 'pending';
        if ($data->catatan) {
            $bebasLab->catatan = $data->catatan;
        }
        $bebasLab->save();

        $berkas->move($path, $berkasName);
        $slip->move($path, $slipName);

        return [
            'status' => 'success',
            'message' => 'Berhasil mengajukan berkas'
        ];
    }

    public function update($id, $status)
    {
        $bebasLab = $this->bebasLab->find($id);
        $bebasLab->status = $status;
        $bebasLab->update();

        File::deleteDirectory(public_path('f/bebaslab/' . $bebasLab->mahasiswa->nim));

        return [
            'status' => 'success',
            'message' => 'Berhasil'
        ];
    }
}
