<?php

namespace App\Http\Services;

use App\Http\Repositories\InformasiRepository;

class InformasiService {
    protected $informasiRepository;

    public function __construct(InformasiRepository $repository)
    {
        $this->informasiRepository = $repository;
    }

    public function getAllInformasi()
    {
        return $this->informasiRepository->get();
    }

    public function getInformasiById($id)
    {
        return $this->informasiRepository->getById($id);
    }

    public function getInformasiFromMonth($month)
    {
        return $this->informasiRepository->getFromMonth($month);
    }

    public function storeData($data)
    {
        $result = $this->informasiRepository->save($data);

        return $result;
    }

    public function updateData($data)
    {
        $result = $this->informasiRepository->update($data);

        return $result;
    }

    public function deleteInformasi($id)
    {
        $this->informasiRepository->destroy($id);
    }
}
