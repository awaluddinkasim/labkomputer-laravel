<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Http\Services\DosenService;
use App\Http\Services\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $dosenService;

    public function __construct(DosenService $dosenService)
    {
        $this->dosenService = $dosenService;
    }

    public function edit()
    {
        return view('dosen.profil');
    }

    public function update(Request $request)
    {
        $result = $this->dosenService->updateData($request, auth()->user()->id);

        return redirect()->back()->with($result['status'], $result['message']);
    }
}
