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

    public function getAll() {
        return $this->dataPraktikanRepository->get();
    }

    public function getDataById($id)
    {
        $this->dataPraktikanRepository->getById($id);
    }

    public function storeData($id, $data)
    {
        $validator = Validator::make($data->all(), [
            'praktikum' => [
                'required',
                Rule::unique('data_praktikan')->where(function ($query) use ($id, $data) {
                    return $query->where('id_user', $id)->where('id_praktikum', $data->praktikum);
                })
            ]
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'success',
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
