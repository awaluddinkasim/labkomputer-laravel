<?php

namespace App\Http\Services;

use App\Http\Repositories\SlipRepository;

class SlipService
{
    protected $slipRepository;

    public function __construct(SlipRepository $repository)
    {
        $this->slipRepository = $repository;
    }

    public function uploadSlip($dp, $data)
    {
        try {
            return $this->slipRepository->store($dp, $data);
        } catch (\Throwable $th) {
            return [
                'status' => 'failed',
                'message' => 'Terjadi kesalahan'
            ];
        }
    }
}
