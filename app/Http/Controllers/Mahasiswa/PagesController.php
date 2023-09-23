<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Http\Services\InformasiService;
use App\Http\Services\PraktikumService;
use App\Http\Services\PengaturanService;

class PagesController extends Controller
{
    protected $informasiService;
    protected $praktikumService;
    protected $pengaturanService;

    public function __construct(
        InformasiService $informasiService,
        PraktikumService $praktikumService,
        PengaturanService $pengaturanService
    ) {
        $this->informasiService = $informasiService;
        $this->praktikumService = $praktikumService;
        $this->pengaturanService = $pengaturanService;

        $unverifiedUser = User::where('active', '0')->get();

        View::share('unverifiedUser', $unverifiedUser->count());
    }

    public function dashboard()
    {
        return view('mahasiswa.dashboard');
    }

    public function informasi()
    {
        $data = [
            'daftarInformasi' => $this->informasiService->getInformasiFromMonth(6)
        ];

        return view('mahasiswa.informasi', $data);
    }

    public function slip()
    {
        $semester = $this->pengaturanService->getSemesterSekarang();
        $data = [
            'daftarData' => auth()->user()->praktikum,
            'daftarPraktikum' => $this->praktikumService->getPraktikumWithPengampu(auth()->user()->id_prodi, $semester ? $semester->value : 'ganjil')
        ];

        return view('mahasiswa.slip', $data);
    }
}
