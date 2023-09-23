<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Validator;
use App\Http\Repositories\PraktikumRepository;
use Illuminate\Validation\Rule;

class PraktikumService
{
    protected $praktikumRepository;

    public function __construct(PraktikumRepository $repository)
    {
        $this->praktikumRepository = $repository;
    }

    public function getAllPraktikum()
    {
        return $this->praktikumRepository->get();
    }

    public function getPraktikumById($id)
    {
        return $this->praktikumRepository->getById($id);
    }

    public function getPraktikumWithPengampu($prodi, $semester)
    {
        return $this->praktikumRepository->getWithPengampu($prodi, $semester);
    }

    public function storeData($data)
    {
        $validator = Validator::make($data->all(), [
            'nama' => [
                'required',
                Rule::unique('praktikum')->where(function ($query) use ($data) {
                    return $query->where('id_prodi', $data->prodi)->where('nama', $data->nama);
                })
            ]
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'failed',
                'message' => 'Praktikum yang Anda input sudah ada'
            ];
        }

        $result = $this->praktikumRepository->save($data);

        return $result;
    }

    public function updateData($data)
    {
        $validator = Validator::make($data->all(), [
            'nama' => [
                'required',
                Rule::unique('praktikum')->where(function ($query) use ($data) {
                    return $query->where('id_prodi', $data->prodi)->where('nama', $data->nama);
                })->ignore($data->id)
            ]
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'failed',
                'message' => 'Praktikum yang Anda input sudah ada'
            ];
        }

        $result = $this->praktikumRepository->update($data);

        return $result;
    }

    public function deletePraktikum($id)
    {
        $result = $this->praktikumRepository->destroy($id);

        return $result;
    }
}
