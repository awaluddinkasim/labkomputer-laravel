<?php

namespace App\Http\Services;

use App\Http\Repositories\DataPraktikanRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DataPraktikanService
{
    protected $dataPraktikanRepository;

    public function __construct(DataPraktikanRepository $repository)
    {
        $this->dataPraktikanRepository = $repository;
    }

    public function getAll()
    {
        return $this->dataPraktikanRepository->get();
    }

    public function getDataById($id)
    {
        return $this->dataPraktikanRepository->getById($id);
    }

    public function storeData($id, $data)
    {
        $validator = Validator::make($data->all(), [
            'praktikum' => [
                'required',
                Rule::unique('data_praktikan', 'id_praktikum')->where('id_user', $id)
            ]
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'failed',
                'message' => 'Praktikum tersebut sudah ada'
            ];
        }

        return $this->dataPraktikanRepository->store($id, $data);
    }

    public function deleteData($id)
    {
        return $this->dataPraktikanRepository->destroy($id);
    }
}
