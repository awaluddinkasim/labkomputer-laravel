<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\BebasLabService;
use App\Models\BebasLab;
use Illuminate\Http\Request;

class BebasLabController extends Controller
{
    protected $bebasLabService;

    public function __construct(BebasLabService $bebasLabService) {
        $this->bebasLabService = $bebasLabService;
    }

    public function bebasLab($status)
    {
        if ($status == "pending") {
            $pengajuan = $this->bebasLabService->getPendingBebasLab();

            return view('admin.bebas-lab', [
                'daftarPengajuan' => $pengajuan
            ]);
        } else {
            $pengajuan = $this->bebasLabService->getNotPendingBebasLab();

            return view('admin.bebas-lab-arsip', [
                'daftarPengajuan' => $pengajuan
            ]);
        }
    }
}
