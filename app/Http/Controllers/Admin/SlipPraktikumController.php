<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\DataPraktikan;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Http\Services\PraktikumService;
use Illuminate\Contracts\Encryption\DecryptException;

class SlipPraktikumController extends Controller
{
    protected $praktikumService;

    public function __construct(PraktikumService $praktikumService)
    {
        $this->praktikumService = $praktikumService;
    }

    public function slipPraktikum(Request $request)
    {
        if ($request->has('id')) {
            try {
                $id = decrypt($request->id);
            } catch (DecryptException $th) {
                return redirect()->back();
            }

            $praktikum = $this->praktikumService->getPraktikumById($id);

            $data = [
                'praktikum' => $praktikum->nama,
                'daftarSlip' => $praktikum->slip
            ];

            return view('admin.slip-praktikum-detail', $data);
        }
        $data = [
            'daftarData' => DataPraktikan::distinct()->get(['id_praktikum', 'nidn_dosen'])->sortBy('praktikum.nama')
        ];

        return view('admin.slip-praktikum', $data);
    }

    public function slipPraktikumExport(Request $request)
    {
        if ($request->has('type') && $request->has('id')) {
            try {
                $id = decrypt($request->id);
            } catch (DecryptException $e) {
                return redirect()->back();
            }

            $data = [
                'daftarSlip' => $this->praktikumService->getPraktikumById($id)->slip
            ];

            if ($request->type == "pdf") {
                $pdf = Pdf::loadView('exports.pdf', $data)
                    ->setPaper('a4');
                return $pdf->stream('slip.pdf');
            }
        }
        return redirect()->back();
    }
}
