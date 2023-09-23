<?php

namespace App\Http\Services;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Http\Repositories\ProdiRepository;

class ProdiService
{
    protected $prodiRepository;

    public function __construct(ProdiRepository $repository)
    {
        $this->prodiRepository = $repository;
    }

    public function getAllProdi()
    {
        return $this->prodiRepository->get();
    }

    public function getProdiById($id)
    {
        return $this->prodiRepository->getById($id);
    }

    public function storeData($data)
    {
        $validator = Validator::make($data->all(), [
            'prodi' => 'unique:prodi,nama'
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'failed',
                'message' => 'Prodi yang Anda input sudah ada'
            ];
        }

        $result = $this->prodiRepository->save($data);

        return $result;
    }

    public function updateData($data)
    {
        $validator = Validator::make($data->all(), [
            'fakultas' => [
                'required',
                Rule::unique('prodi', 'nama')->ignore($data->id)
            ]
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'failed',
                'message' => 'Prodi yang Anda input sudah ada'
            ];
        }

        $result = $this->prodiRepository->update($data);

        return $result;
    }

    public function deleteProdi($id)
    {
        $result = $this->prodiRepository->destroy($id);

        return $result;
    }
}
