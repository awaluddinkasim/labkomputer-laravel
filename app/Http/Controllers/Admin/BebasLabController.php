<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BebasLab;
use Illuminate\Http\Request;

class BebasLabController extends Controller
{
    public function bebasLab($status)
    {
        if ($status == "pending") {
            $pengajuan = BebasLab::where('status', 'pending')->get();
        } else {
            $pengajuan = BebasLab::where('status', 'selesai')->orWhere('status', 'ditolak')->get();
        }
        return view('admin.bebas-lab', [
            'daftarPengajuan' => $pengajuan
        ]);
    }
}
