<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\FakultasService;
use App\Http\Services\PraktikumService;

class PraktikumController extends Controller
{
    protected $praktikumService;
    protected $fakultasService;

    public function __construct(PraktikumService $praktikumService, FakultasService $fakultasService)
    {
        $this->praktikumService = $praktikumService;
        $this->fakultasService = $fakultasService;
    }

    public function store(Request $request)
    {
        $result = $this->praktikumService->storeData($request);

        return redirect()->back()->with($result['status'], $result['message']);
    }

    public function edit(Request $request)
    {
        $data = [
            'daftarFakultas' => $this->fakultasService->getAllFakultas(),
            'praktikum' => $this->praktikumService->getPraktikumById($request->id)
        ];

        return view('admin.master-praktikum-edit', $data);
    }

    function update(Request $request)
    {
        try {
            $result = $this->praktikumService->updateData($request);

            return redirect()->route('admin.master', 'praktikum')->with($result['status'], $result['message']);
        } catch (\Throwable $th) {
            return redirect()->route('admin.master', 'praktikum')->with('failed', 'Terjadi kesalahan');
        }
    }

    public function delete(Request $request)
    {
        try {
            $result = $this->praktikumService->deletePraktikum($request->id);

            return redirect()->back()->with($result['status'], $result['message']);
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
}
