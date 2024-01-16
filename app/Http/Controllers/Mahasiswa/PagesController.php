<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Http\Services\InformasiService;
use App\Models\DataPraktikan;

class PagesController extends Controller
{
    protected $informasiService;

    public function __construct(InformasiService $informasiService)
    {
        $this->informasiService = $informasiService;

        $unverifiedUser = User::where('active', '0')->get();

        View::share('unverifiedUser', $unverifiedUser->count());
    }

    public function dashboard()
    {
        $data = [
            'slip' => DataPraktikan::where('id_user', auth()->user()->id)->has('slip')->get()->count(),
        ];

        return view('mahasiswa.dashboard', $data);
    }

    public function informasi()
    {
        $data = [
            'daftarInformasi' => $this->informasiService->getInformasiFromMonth(6)
        ];

        return view('mahasiswa.informasi', $data);
    }
}
