<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\PengaturanService;

class PengaturanController extends Controller
{
    protected $pengaturanService;

    public function __construct(PengaturanService $pengaturanService) {
        $this->pengaturanService = $pengaturanService;
    }

    public function save(Request $request)
    {
        $result = $this->pengaturanService->save($request);

        return redirect()->back()->with($result['status'], $result['message']);
    }
}
