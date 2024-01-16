<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Services\DataPraktikanService;
use App\Http\Services\PraktikumService;
use App\Http\Services\PengaturanService;
use App\Http\Services\SlipService;
use Illuminate\Http\Request;

class SlipController extends Controller
{
    protected $praktikumService;
    protected $pengaturanService;
    protected $dataPraktikanService;
    protected $slipService;

    public function __construct(
        PraktikumService $praktikumService,
        PengaturanService $pengaturanService,
        DataPraktikanService $dataPraktikanService,
        SlipService $slipService
    ) {
        $this->praktikumService = $praktikumService;
        $this->pengaturanService = $pengaturanService;
        $this->dataPraktikanService = $dataPraktikanService;
        $this->slipService = $slipService;
    }

    public function slip()
    {
        $semester = $this->pengaturanService->getSemesterSekarang();
        $data = [
            'upload' => $this->pengaturanService->getStatusUpload(),
            'daftarData' => auth()->user()->praktikum,
            'daftarPraktikum' => $this->praktikumService->getPraktikumWithPengampu(auth()->user()->id_prodi, $semester ? $semester->value : 'ganjil')
        ];

        return view('mahasiswa.slip', $data);
    }

    public function store(Request $request)
    {
        if ($this->pengaturanService->getStatusUpload() != "closed") {
            $dp = $this->dataPraktikanService->getDataById($request->id);

            $result = $this->slipService->uploadSlip($dp, $request);

            return redirect()->back()->with($result['status'], $result['message']);
        } else {
            return redirect()->back()->with('failed', 'Upload slip telah tertutup');
        }
    }
}
