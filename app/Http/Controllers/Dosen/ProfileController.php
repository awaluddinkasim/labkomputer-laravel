<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Http\Services\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $profileService;

    public function __construct(ProfileService $profileService) {
        $this->profileService = $profileService;
    }

    public function edit()
    {
        return view('dosen.profil');
    }

    public function update(Request $request)
    {
        $result = $this->profileService->updateDosen(auth()->user()->id, $request);

        return redirect()->with($result['status'], $result['message']);
    }
}
