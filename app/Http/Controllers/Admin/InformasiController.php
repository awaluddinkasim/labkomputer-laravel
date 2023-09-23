<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\InformasiService;

class InformasiController extends Controller
{
    protected $informasiService;

    public function __construct(InformasiService $service)
    {
        $this->informasiService = $service;
    }

    public function get(Request $request)
    {
        if ($request->has('id')) {
            $data = [
                'informasi' => $this->informasiService->getInformasiById($request->id)
            ];

            return view('admin.informasi-edit', $data);
        }
        $data = [
            'daftarInformasi' => $this->informasiService->getAllInformasi()
        ];

        return view('admin.informasi', $data);
    }

    public function informasiStore(Request $request)
    {
        try {
            $this->informasiService->storeData($request);

            return redirect()->route('admin.informasi')->with('success', 'Berhasil menambah informasi');
        } catch (\Throwable $th) {
            return redirect()->route('admin.informasi')->with('failed', 'Terjadi kesalahan');
        }
    }

    public function informasiUpdate(Request $request)
    {
        try {
            $this->informasiService->updateData($request);

            return redirect()->route('admin.informasi')->with('success', 'Berhasil update informasi');
        } catch (\Throwable $th) {
            return redirect()->route('admin.informasi')->with('failed', 'Terjadi kesalahan');
        }

    }

    public function informasiDelete(Request $request)
    {
        try {
            $this->informasiService->deleteInformasi($request->id);

            return redirect()->route('admin.informasi')->with('success', 'Data informasi berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('admin.informasi')->with('failed', 'Terjadi kesalahan');
        }

    }
}
