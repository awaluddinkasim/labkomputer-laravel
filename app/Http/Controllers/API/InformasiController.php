<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Informasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InformasiController extends Controller
{
    public function get()
    {
        $data = [
            'daftarInformasi' => Informasi::whereBetween('created_at', [Carbon::now()->subMonth(6), Carbon::now()])->orderBy('created_at', 'DESC')->get()
        ];

        return response()->json($data, 200);
    }
}
