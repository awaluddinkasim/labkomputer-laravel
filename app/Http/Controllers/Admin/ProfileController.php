<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService) {
        $this->profileService = $profileService;
    }

    public function edit()
    {
        return view('admin.profil');
    }

    public function update(Request $request)
    {
        $result = $this->profileService->updateAdmin(auth()->user()->id, $request);

        return redirect()->back()->with($result['status'], $result['message']);
    }
}
