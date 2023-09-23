<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\BebasLabService;
use App\Models\BebasLab;
use Illuminate\Http\Request;

class BebasLabController extends Controller
{
    protected $bebasLabService;

    public function __construct(BebasLabService $bebasLabService) {
        $this->bebasLabService = $bebasLabService;
    }

    public function index($status)
    {
        if ($status == "pending") {
            $pengajuan = $this->bebasLabService->getPendingBebasLab();

            return view('admin.bebas-lab', [
                'daftarPengajuan' => $pengajuan
            ]);
        } else {
            $pengajuan = $this->bebasLabService->getNotPendingBebasLab();

            return view('admin.bebas-lab-arsip', [
                'daftarPengajuan' => $pengajuan
            ]);
        }
    }

    public function detail($id)
    {
        $data = [
            'bebasLab' => $this->bebasLabService->getBebasLabById($id)
        ];

        return view('admin.bebas-lab-detail', $data);
    }

    public function update(Request $request, $id)
    {
        $result = $this->bebasLabService->updateBebasLab($id, $request->status);

        if ($result['status'] == "success") {
            return redirect()->route('admin.bebas-lab', 'arsip')->with($result['status'], $result['message']);
        }
        return redirect()->route('admin.bebas-lab', 'pending')->with($result['status'], $result['message']);
    }
}
