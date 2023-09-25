<?php

namespace App\Http\Services;

use App\Http\Repositories\BebasLabRepository;

class BebasLabService
{
    protected $bebasLabRepository;

    public function __construct(BebasLabRepository $repository)
    {
        $this->bebasLabRepository = $repository;
    }

    public function getPendingBebasLab()
    {
        return $this->bebasLabRepository->getPending();
    }

    public function getNotPendingBebasLab()
    {
        return $this->bebasLabRepository->getNotPending();
    }

    public function getBebasLabById($id)
    {
        return $this->bebasLabRepository->getById($id);
    }

    public function storeBebasLab($user, $data)
    {
        try {
            return $this->bebasLabRepository->store($user, $data);
        } catch (\Throwable $th) {
            return [
                'status' => 'failed',
                'message' => 'Terjadi kesalahan'
            ];
        }
    }

    public function updateBebasLab($id, $status)
    {
        try {
            return $this->bebasLabRepository->update($id, $status);
        } catch (\Throwable $th) {
            return [
                'status' => 'failed',
                'message' => 'Terjadi kesalahan'
            ];
        }
    }
}
