<?php

namespace App\Http\Services;

use App\Http\Repositories\SlipRepository;
use Illuminate\Support\Facades\Validator;

class SlipService
{
    protected $slipRepository;

    public function __construct(SlipRepository $repository)
    {
        $this->slipRepository = $repository;
    }

    public function uploadSlip($dp, $data)
    {
        $validator = Validator::make($data->all(), [
            'tgl' => 'required',
            'nominal' => 'required',
            'slip' => 'required|image'
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'failed',
                'message' => 'Data tidak valid'
            ];
        }

        try {
            return $this->slipRepository->store($dp, $data);
        } catch (\Throwable $th) {
            return [
                'status' => 'failed',
                'message' => 'Terjadi kesalahan'
            ];
        }
    }

    public function deleteSlip($data)
    {
        try {
            return $this->slipRepository->delete($data);
        } catch (\Throwable $th) {
            return [
                'status' => 'failed',
                'message' => 'Terjadi kesalahan'
            ];
        }
    }
}
