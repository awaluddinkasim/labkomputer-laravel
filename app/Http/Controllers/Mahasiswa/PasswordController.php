<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Services\MahasiswaService;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    protected $mahasiswaService;

    public function __construct(MahasiswaService $mahasiswaService) {
        $this->mahasiswaService = $mahasiswaService;
    }

    public function index()
    {
        return view('mahasiswa.new-password');
    }

    public function update(Request $request)
    {
        $result = $this->mahasiswaService->updatePasswordMahasiswa(auth()->user()->id, $request);

        if ($result['status'] == 'success') {
            return view('mahasiswa.new-password-success', [
                'message' => $result['message']
            ]);
        }

        return redirect()->back()->with($result['status'], $result['message']);
    }
}
