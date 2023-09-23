<?php

namespace App\Http\Services;

use App\Http\Repositories\ProfileRepository;

class ProfileService {
    protected $profileRepository;

    public function __construct(ProfileRepository $repository) {
        $this->profileRepository = $repository;
    }

    public function updateAdmin($id, $data) {
        return $this->profileRepository->updateAdmin($id, $data);
    }

    public function updateDosen($id, $data) {
        return $this->profileRepository->updateDosen($id, $data);
    }

    public function updateMahasiswa($id, $data) {
        return $this->profileRepository->updateMahasiswa($id, $data);
    }
}
