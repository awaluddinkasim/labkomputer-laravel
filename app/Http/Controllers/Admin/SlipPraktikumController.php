<?php

namespace App\Http\Controllers\Admin;

use Excel;
use App\Exports\SlipExport;
use Illuminate\Http\Request;
use App\Models\DataPraktikan;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Services\SlipService;
use App\Http\Controllers\Controller;
use App\Http\Services\PraktikumService;
use Illuminate\Contracts\Encryption\DecryptException;

class SlipPraktikumController extends Controller
{
    protected $praktikumService;
    protected $slipService;

    public function __construct(PraktikumService $praktikumService, SlipService $slipService)
    {
        $this->praktikumService = $praktikumService;
        $this->slipService = $slipService;
    }

    public function index(Request $request)
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

    public function delete(Request $request)
    {
        $result = $this->slipService->deleteSlip($request);

        return redirect()->back()->with($result['status'], $result['message']);
    }

    public function export(Request $request)
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
        } else {
            abort(404);
        }
    }
}
