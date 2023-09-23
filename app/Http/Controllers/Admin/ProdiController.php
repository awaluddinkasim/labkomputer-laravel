<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Services\ProdiService;
use App\Http\Controllers\Controller;
use App\Http\Services\FakultasService;

class ProdiController extends Controller
{
    protected $prodiService;
    protected $fakultasService;

    public function __construct(ProdiService $prodiService, FakultasService $fakultasService)
    {
        $this->prodiService = $prodiService;
        $this->fakultasService = $fakultasService;
    }

    public function store(Request $request) {
        try {
            $result = $this->prodiService->storeData($request);

            return redirect()->back()->with($result['status'], $result['message']);
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    public function edit(Request $request) {
        $data = [
            'daftarFakultas' => $this->fakultasService->getAllFakultas(),
            'prodi' => $this->prodiService->getProdiById($request->id)
        ];

        return view('admin.master-prodi-edit', $data);
    }

    function update(Request $request) {
        try {
            $result = $this->prodiService->updateData($request);

            return redirect()->route('admin.master', 'prodi')->with($result['status'], $result['message']);
        } catch (\Throwable $th) {
            return redirect()->route('admin.master', 'prodi')->with('success', 'Program studi berhasil diupdate');
        }
    }

    public function delete(Request $request) {
        try {
            $result = $this->prodiService->deleteProdi($request->id);

            return redirect()->back()->with($result['status'], $result['message']);
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
}
