<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\BebasLab;
use Illuminate\Http\Request;

class BebasLabController extends Controller
{
    public function index()
    {
        $bebasLab = BebasLab::where('id_user', auth()->user()->id)->first();

        if ($bebasLab) {
            return view('mahasiswa.bebas-lab', [
                'bebasLab' => $bebasLab
            ]);
        }
        return redirect()->route('bebas-lab.upload');
    }

    public function upload()
    {
        $bebasLab = BebasLab::where('id_user', auth()->user()->id)->first();

        if (!$bebasLab || $bebasLab->status == "ditolak") {
            return view('mahasiswa.bebas-lab-upload');
        }
        return redirect()->route('bebas-lab');
    }

    public function store(Request $request)
    {

    }
}
