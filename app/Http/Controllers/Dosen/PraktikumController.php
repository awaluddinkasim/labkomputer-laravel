<?php

namespace App\Http\Controllers\Dosen;

use Excel;
use App\Exports\SlipExport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Http\Services\MahasiswaService;
use App\Http\Services\PraktikumService;
use Illuminate\Contracts\Encryption\DecryptException;

class PraktikumController extends Controller
{
    private $praktikumService;
    private $mahasiswaService;

    public function __construct(PraktikumService $praktikumService, MahasiswaService $mahasiswaService)
    {
        $this->praktikumService = $praktikumService;
        $this->mahasiswaService = $mahasiswaService;
    }

    public function index()
    {
        return view('dosen.praktikum');
    }

    public function mahasiswa(Request $request, $id)
    {
        if ($request->has('id')) {
            try {
                $decrypted = decrypt($request->id);
            } catch (DecryptException $e) {
                return redirect()->back();
            }

            $mahasiswa = $this->mahasiswaService->getMahasiswaById($decrypted);

            return view('dosen.praktikum-mahasiswa-detail', ['mahasiswa' => $mahasiswa]);
        }

        try {
            $decrypted = decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back();
        }

        $praktikum = $this->praktikumService->getPraktikumById($decrypted);

        return view('dosen.praktikum-mahasiswa', ['praktikum' => $praktikum, 'daftarUser' => $praktikum->praktikan]);
    }

    public function slip($id)
    {
        try {
            $decrypted = decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back();
        }

        $praktikum = $this->praktikumService->getPraktikumById($decrypted);

        return view('dosen.praktikum-slip', [
            'praktikum' => $praktikum,
            'daftarSlip' => $praktikum->slip
        ]);
    }

    public function slipExport(Request $request)
    {
        if ($request->has('type') && $request->has('id')) {
            try {
                $id = decrypt($request->id);
            } catch (DecryptException $e) {
                return redirect()->back();
            }

            $praktikum = $this->praktikumService->getPraktikumById($id);

            $data = [
                'daftarSlip' => $praktikum->slip
            ];

            if ($request->type == "pdf") {
                $pdf = Pdf::loadView('exports.pdf', $data)
                    ->setPaper('a4');
                return $pdf->stream('slip.pdf');
            }
            if ($request->type = "excel") {
                return Excel::download(new SlipExport($praktikum), 'slip-'. $praktikum->nama .'-'. time() .'.xlsx');
            }
        }
        return redirect()->back();
    }
}
