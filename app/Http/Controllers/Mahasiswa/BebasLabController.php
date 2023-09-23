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
        $path = public_path('f/bebaslab/'. auth()->user()->nim);
        $slip = $request->file('bukti-bayar');
        $slipName = 'slip-'.time().'.'.$slip->extension();

        $berkas = $request->file('berkas');
        $berkasName = 'berkas'.time().'.'.$berkas->extension();

        $bebasLab = new BebasLab();
        $bebasLab->id_user = auth()->user()->id;
        $bebasLab->bukti_bayar = $slipName;
        $bebasLab->berkas = $berkasName;
        $bebasLab->status = 'pending';
        if ($request->catatan) {
            $bebasLab->catatan = $request->catatan;
        }
        $bebasLab->save();

        $berkas->move($path, $berkasName);
        $slip->move($path, $slipName);

        return redirect()->route('bebas-lab');
    }
}
