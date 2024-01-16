<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\AdminService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function edit()
    {
        return view('admin.profil');
    }

    public function update(Request $request)
    {
        $result = $this->adminService->updateAdmin(auth()->user()->id, $request);

        return redirect()->back()->with($result['status'], $result['message']);
    }
}
