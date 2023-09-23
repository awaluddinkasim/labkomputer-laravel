<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\DataPraktikanService;

class PraktikumController extends Controller
{
    protected $dataPraktikanService;

    public function __construct(DataPraktikanService $dataPraktikanService)
    {
        $this->dataPraktikanService = $dataPraktikanService;
    }

    public function tambahPraktikum(Request $request)
    {
        try {
            $result = $this->dataPraktikanService->storeData(auth()->user()->id, $request);

            return redirect()->back()->with($result['status'], $result['message']);
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    public function hapusPraktikum(Request $request)
    {
        try {
            $result = $this->dataPraktikanService->deleteData($request->id);

            return redirect()->back()->with($result['status'], $result['message']);
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
}
