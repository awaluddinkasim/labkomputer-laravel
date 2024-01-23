<?php

namespace App\Http\Controllers\Asisten;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\FakultasService;
use App\Http\Services\MahasiswaService;

class MahasiswaController extends Controller
{
    protected $mahasiswaService;
    protected $fakultasService;

    public function __construct(MahasiswaService $mahasiswaService, FakultasService $fakultasService)
    {
        $this->mahasiswaService = $mahasiswaService;
        $this->fakultasService = $fakultasService;
    }

    public function show()
    {
        $data = [
            'daftarUser' => $this->mahasiswaService->getAllMahasiswa(auth()->user()->id)
        ];

        return view('aslab.daftar-mahasiswa', $data);
    }


    public function detail($id)
    {
        $data = [
            'mahasiswa' => $this->mahasiswaService->getMahasiswaById($id)
        ];

        return view('aslab.mahasiswa-detail', $data);
    }

    public function edit($id)
    {
        $data = [
            'daftarFakultas' => $this->fakultasService->getAllFakultas(),
            'mahasiswa' => $this->mahasiswaService->getMahasiswaById($id)
        ];

        return view('aslab.mahasiswa-edit', $data);
    }

    public function update(Request $request, $id)
    {
        $result = $this->mahasiswaService->updateData($request, $id);

        return redirect()->route('asisten.mahasiswa-detail', $id)->with($result['status'], $result['message']);
    }

    public function action(Request $request, $action)
    {
        switch ($action) {
            case 'verifikasi':
                $result = $this->mahasiswaService->verifikasiMahasiswa($request->id);

                return redirect()->route('asisten.daftar-mahasiswa')->with($result['status'], $result['message']);

            case 'tolak':
                $result = $this->mahasiswaService->tolakMahasiswa($request->id);

                return redirect()->route('asisten.daftar-mahasiswa')->with($result['status'], $result['message']);

            default:
                return redirect()->route('dashboard');
        }
    }
}
