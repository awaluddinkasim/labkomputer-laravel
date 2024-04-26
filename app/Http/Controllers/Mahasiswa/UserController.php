<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Services\FakultasService;
use App\Http\Services\MahasiswaService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $fakultasService;
    protected $mahasiswaService;

    public function __construct(FakultasService $fakultasService, MahasiswaService $mahasiswaService)
    {
        $this->fakultasService = $fakultasService;
        $this->mahasiswaService = $mahasiswaService;
    }

    public function register()
    {
        $data = [
            'daftarFakultas' => $this->fakultasService->getFakultasWithProdi()
        ];
        return view('mahasiswa.register', $data);
    }

    public function store(Request $request)
    {
        $result = $this->mahasiswaService->storeData($request);

        return redirect()->route($result['status'] == "success" ? 'login' : 'register')->with($result['status'], $result['message']);
    }

    public function edit()
    {
        $data = [
            'daftarFakultas' => $this->fakultasService->getFakultasWithProdi()
        ];

        return view('mahasiswa.profil', $data);
    }

    public function update(Request $request)
    {
        $result = $this->mahasiswaService->updateData($request, auth()->user()->id);

        return redirect()->back()->with($result['status'], $result['message']);
    }
}
