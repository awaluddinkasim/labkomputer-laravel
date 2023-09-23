<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\FakultasService;

class FakultasController extends Controller
{
    protected $fakultasService;

    public function __construct(FakultasService $fakultasService)
    {
        $this->fakultasService = $fakultasService;
    }

    public function store(Request $request) {
        try {
            $result = $this->fakultasService->storeData($request);

            return redirect()->back()->with($result['status'], $result['message']);
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    public function edit(Request $request) {
        $data = [
            'fakultas' => $this->fakultasService->getFakultasById($request->id)
        ];

        return view('admin.master-fakultas-edit', $data);
    }

    function update(Request $request) {
        try {
            $result = $this->fakultasService->updateData($request);

            return redirect()->route('admin.master', 'fakultas')->with($result['status'], $result['message']);
        } catch (\Throwable $th) {
            return redirect()->route('admin.master', 'fakultas')->with('failed', 'Terjadi kesalahan');
        }
    }

    public function delete(Request $request) {
        try {
            $result = $this->fakultasService->deleteFakultas($request->id);

            return redirect()->back()->with($result['status'], $result['message']);
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
}
