<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slip;
use App\Models\User;
use App\Http\Services\DosenService;
use App\Http\Services\ProdiService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Http\Services\FakultasService;
use App\Http\Services\MahasiswaService;
use App\Http\Services\PraktikumService;

class PagesController extends Controller
{
    protected $fakultasService;
    protected $prodiService;
    protected $praktikumService;
    protected $dosenService;
    protected $mahasiswaService;

    public function __construct(
        FakultasService $fakultasService,
        ProdiService $prodiService,
        PraktikumService $praktikumService,
        DosenService $dosenService,
        MahasiswaService $mahasiswaService
    )
    {
        $this->fakultasService = $fakultasService;
        $this->prodiService = $prodiService;
        $this->praktikumService = $praktikumService;
        $this->dosenService = $dosenService;
        $this->mahasiswaService = $mahasiswaService;


        $unverifiedUser = User::where('active', '0')->get();

        View::share('unverifiedUser', $unverifiedUser->count());
    }

    public function dashboard()
    {
        $data = [
            'slip' => Slip::all()->count(),
            'mahasiswaAktif' => $this->mahasiswaService->getMahasiswaActive()->count(),
        ];

        return view('admin.dashboard', $data);
    }

    public function masterData($jenis)
    {
        switch ($jenis) {
            case 'fakultas':
                $data = [
                    'daftarFakultas' => $this->fakultasService->getAllFakultas()
                ];

                return view('admin.master-fakultas', $data);

            case 'prodi':
                $data = [
                    'daftarFakultas' => $this->fakultasService->getAllFakultas(),
                    'daftarJurusan' => $this->prodiService->getAllProdi()
                ];

                return view('admin.master-prodi', $data);

            case 'praktikum':
                $data = [
                    'daftarFakultas' => $this->fakultasService->getAllFakultas(),
                    'daftarPraktikum' => $this->praktikumService->getAllPraktikum()
                ];

                return view('admin.master-praktikum', $data);

            default:
                return redirect()->route('admin.dashboard');
        }
    }

    public function akun($jenis)
    {
        switch ($jenis) {
            case 'dosen':
                $data = [
                    'daftarDosen' => $this->dosenService->getAllDosen()
                ];

                return view('admin.akun-dosen', $data);

            case 'mahasiswa':
                $data = [
                    'daftarUser' => $this->mahasiswaService->getAllMahasiswa()
                ];

                return view('admin.akun-mahasiswa', $data);

            default:
                return redirect()->route('admin.dashboard');
        }
    }
}
