<?php

namespace App\Http\Services;

use App\Http\Repositories\PengaturanRepository;


class PengaturanService {
    protected $pengaturanRepository;

    public function __construct(PengaturanRepository $repository) {
        $this->pengaturanRepository = $repository;
    }

    public function getSemesterSekarang() {
        return $this->pengaturanRepository->getSemester();
    }

    public function getStatusUpload() {
        return $this->pengaturanRepository->getUpload();
    }

    public function save($data) {
        try {
            return $this->pengaturanRepository->save($data);
        } catch (\Throwable $th) {
            return [
                'status' => 'failed',
                'message' => 'Terjadi kesalahan'
            ];
        }
    }
}
