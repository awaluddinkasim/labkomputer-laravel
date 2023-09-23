<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\FakultasService;
use App\Http\Services\MahasiswaService;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    protected $mahasiswaService;
    protected $fakultasService;

    public function __construct(MahasiswaService $mahasiswaService, FakultasService $fakultasService)
    {
        $this->mahasiswaService = $mahasiswaService;
        $this->fakultasService = $fakultasService;
    }

    public function detail($id)
    {
        $data = [
            'mahasiswa' => $this->mahasiswaService->getMahasiswaById($id)
        ];

        return view('admin.akun-mahasiswa-detail', $data);
    }

    public function edit($id)
    {
        $data = [
            'daftarFakultas' => $this->fakultasService->getAllFakultas(),
            'mahasiswa' => $this->mahasiswaService->getMahasiswaById($id)
        ];

        return view('admin.akun-mahasiswa-edit', $data);
    }

    public function update(Request $request, $id)
    {
        $result = $this->mahasiswaService->updateData($request, $id, true);

        return redirect()->route('admin.mhs-detail', $id)->with($result['status'], $result['message']);
    }

    public function action(Request $request, $action)
    {
        switch ($action) {
            case 'verifikasi':
                $result = $this->mahasiswaService->verifikasiMahasiswa($request->id);

                return redirect()->route('admin.akun', 'mahasiswa')->with($result['status'], $result['message']);

            case 'tolak':
                $result = $this->mahasiswaService->tolakMahasiswa($request->id);

                return redirect()->route('admin.akun', 'mahasiswa')->with($result['status'], $result['message']);

            default:
                return redirect()->route('admin.dashboard');
        }
    }

    public function delete(Request $request)
    {
        $result = $this->mahasiswaService->deleteData($request->id);

        return redirect()->back()->with($result['status'], $result['message']);
    }
}
