<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use App\Http\Services\DataPraktikanService;
use App\Http\Services\PraktikumService;
use Illuminate\Http\Request;

class SlipPraktikumController extends Controller
{
    protected $praktikumService;
    protected $dataPraktikanService;

    public function __construct(PraktikumService $praktikumService, DataPraktikanService $dataPraktikanService) {
        $this->praktikumService = $praktikumService;
        $this->dataPraktikanService = $dataPraktikanService;
    }

    public function show(Request $request)
    {
        if ($request->has('id')) {
            $praktikum = $this->praktikumService->getPraktikumById($request->id);

            $data = [
                'praktikum' => $praktikum->nama,
                'daftarSlip' => $praktikum->slip
            ];

            return view('aslab.slip-praktikum-detail', $data);
        }
        $data = [
            'daftarData' => $this->dataPraktikanService->getAll()
        ];

        return view('aslab.slip-praktikum', $data);
    }
}
