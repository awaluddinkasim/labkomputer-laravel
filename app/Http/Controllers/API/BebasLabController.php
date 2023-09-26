<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Services\BebasLabService;
use App\Models\BebasLab;
use Illuminate\Http\Request;

class BebasLabController extends Controller
{
    protected $bebasLabService;

    public function __construct(BebasLabService $bebasLabService)
    {
        $this->bebasLabService = $bebasLabService;
    }

    public function get(Request $request)
    {
        return response()->json([
            'message' => 'berhasil',
            'bebaslab' => $request->user()->bebaslab
        ], 200);
    }

    public function store(Request $request)
    {
        $path = public_path('f/bebaslab/' . $request->user()->nim);
        $slip = $request->file('bukti-bayar');
        $slipName = 'slip-' . time() . '.' . $slip->extension();

        $berkas = $request->file('berkas');
        $berkasName = 'berkas-' . time() . '.' . $berkas->extension();

        $bebasLab = $request->user()->bebasLab;
        if ($bebasLab) {
            $bebasLab->delete();
        }
        $bebasLab = new BebasLab();
        $bebasLab->id_user = $request->user()->id;
        $bebasLab->bukti_bayar = $slipName;
        $bebasLab->berkas = $berkasName;
        $bebasLab->status = 'pending';
        if ($request->catatan) {
            $bebasLab->catatan = $request->catatan;
        }
        $bebasLab->save();

        $berkas->move($path, $berkasName);
        $slip->move($path, $slipName);

        return response()->json([
            'message' => 'berhasil',
            'bebaslab' => $request->user()->bebaslab
        ], 200);
    }
}
