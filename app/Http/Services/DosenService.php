<?php

namespace App\Http\Services;

use Illuminate\Database\QueryException;
use App\Http\Repositories\DosenRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DosenService
{
    protected $dosenRepository;

    public function __construct(DosenRepository $repository)
    {
        $this->dosenRepository = $repository;
    }

    public function getAllDosen()
    {
        return $this->dosenRepository->get();
    }

    public function getDosenById($id)
    {
        return $this->dosenRepository->getById($id);
    }

    public function storeData($data)
    {
        try {
            $result = $this->dosenRepository->store($data);

            return $result;
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return [
                    'status' => 'failed',
                    'message' => 'Akun dengan NIDN tersebut sudah terdaftar sebelumnya',
                ];
            }
        }
    }

    public function updateData($data, $id)
    {
        try {
            $result = $this->dosenRepository->update($data, $id);

            return $result;
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return [
                    'status' => 'failed',
                    'message' => 'Gagal, NIDN tersebut sudah terdaftar pada akun lain',
                ];
            }
            return [
                'status' => 'failed',
                'message' => 'Terjadi kesalahan',
            ];
        }
    }

    public function deleteData($id)
    {
        $result = $this->dosenRepository->destroy($id);

        return $result;
    }

    public function tambahPraktikumDosen($data, $id)
    {
        $validator = Validator::make($data->all(), [
            'praktikum' => [
                'required',
                Rule::unique('data_pengampu', 'id_praktikum')->where(function ($query) use ($data, $id) {
                    return $query->where('id_dosen', $id)->where('id_praktikum', $data->praktikum);
                })
            ]
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'failed',
                'message' => 'Praktikum yang Anda pilih sudah terdaftar pada akun ini'
            ];
        }

        return $this->dosenRepository->tambahPraktikum($data, $id);
    }

    public function hapusPraktikumDosen($id)
    {
        $result = $this->dosenRepository->hapusPraktikum($id);

        return $result;
    }
}
