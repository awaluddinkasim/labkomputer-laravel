<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Services\BebasLabService;
use Illuminate\Http\Request;

class BebasLabController extends Controller
{
    protected $bebasLabService;

    public function __construct(BebasLabService $bebasLabService)
    {
        $this->bebasLabService = $bebasLabService;
    }

    public function index()
    {
        $bebasLab = auth()->user()->bebasLab;

        if ($bebasLab) {
            return view('mahasiswa.bebas-lab', [
                'bebasLab' => $bebasLab
            ]);
        }
        return redirect()->route('bebas-lab.upload');
    }

    public function upload()
    {
        $bebasLab = auth()->user()->bebasLab;

        if (!$bebasLab || $bebasLab->status == "ditolak") {
            return view('mahasiswa.bebas-lab-upload');
        }
        return redirect()->route('bebas-lab');
    }

    public function store(Request $request)
    {
        $result = $this->bebasLabService->storeBebasLab(auth()->user(), $request);

        if ($result['status'] == "success") {
            return redirect()->route('bebas-lab');
        }

        return redirect()->back()->with($result['status'], $result['message']);
    }
}
