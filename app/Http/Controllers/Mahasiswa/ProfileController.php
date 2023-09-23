<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\FakultasService;
use App\Http\Services\ProfileService;

class ProfileController extends Controller
{
    protected $fakultasService;
    protected $profileService;

    public function __construct(FakultasService $fakultasService, ProfileService $profileService) {
        $this->fakultasService = $fakultasService;
        $this->profileService = $profileService;
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
        $result = $this->profileService->updateMahasiswa(auth()->user()->id, $request);

        return redirect()->back()->with($result['status'], $result['message']);
    }
}
