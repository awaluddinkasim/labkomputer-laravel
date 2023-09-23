<?php


namespace App\Http\Services;

use Illuminate\Support\Facades\Validator;
use App\Http\Repositories\FakultasRepository;
use Illuminate\Validation\Rule;

class FakultasService
{
    protected $fakultasRepository;

    public function __construct(FakultasRepository $repository)
    {
        $this->fakultasRepository = $repository;
    }

    public function getAllFakultas()
    {
        return $this->fakultasRepository->get();
    }

    public function getFakultasById($id)
    {
        return $this->fakultasRepository->getById($id);
    }

    public function getFakultasWithProdi()
    {
        return $this->fakultasRepository->getWithProdi();
    }

    public function storeData($data)
    {
        $validator = Validator::make($data->all(), [
            'fakultas' => 'unique:fakultas,nama'
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'failed',
                'message' => 'Fakultas yang Anda input sudah ada'
            ];
        }

        $result = $this->fakultasRepository->save($data);

        return $result;
    }

    public function updateData($data)
    {
        $validator = Validator::make($data->all(), [
            'fakultas' => [
                'required',
                Rule::unique('fakultas', 'nama')->ignore($data->id)
            ]
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'failed',
                'message' => 'Fakultas yang Anda input sudah ada'
            ];
        }

        $result = $this->fakultasRepository->update($data);

        return $result;
    }

    public function deleteFakultas($id)
    {
        $result = $this->fakultasRepository->destroy($id);

        return $result;
    }
}
