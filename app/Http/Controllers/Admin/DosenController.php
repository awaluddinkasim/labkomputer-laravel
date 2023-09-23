<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\DosenService;
use App\Http\Services\ProdiService;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    protected $dosenService;
    protected $prodiService;

    public function __construct(DosenService $dosenService, ProdiService $prodiService)
    {
        $this->dosenService = $dosenService;
        $this->prodiService = $prodiService;
    }

    public function store(Request $request)
    {
        $result = $this->dosenService->storeData($request);

        return redirect()->back()->with($result['status'], $result['message']);
    }

    public function detail($id)
    {
        $data = [
            'dosen' => $this->dosenService->getDosenById($id),
            'daftarProdi' => $this->prodiService->getAllProdi()
        ];

        return view('admin.akun-dosen-detail', $data);
    }

    public function edit($id)
    {
        $data = [
            'dosen' => $this->dosenService->getDosenById($id),
        ];

        return view('admin.akun-dosen-edit', $data);
    }

    public function update(Request $request, $id)
    {
        $result = $this->dosenService->updateData($request, $id);

        return redirect()->route('admin.dosen-detail', $id)->with($result['status'], $result['message']);
    }

    public function delete(Request $request)
    {
        $result = $this->dosenService->deleteData($request->id);

        return redirect()->back()->with($result['status'], $result['message']);
    }

    public function storePraktikum(Request $request, $id)
    {
        $result = $this->dosenService->tambahPraktikumDosen($request, $id);

        return redirect()->back()->with($result['status'], $result['message']);
    }

    public function deletePraktikum(Request $request)
    {
        $result = $this->dosenService->hapusPraktikumDosen($request->id);

        return redirect()->back()->with($result['status'], $result['message']);
    }
}
