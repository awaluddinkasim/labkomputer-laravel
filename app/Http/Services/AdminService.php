<?php

namespace App\Http\Services;

use App\Http\Repositories\AdminRepository;
use Illuminate\Database\QueryException;

class AdminService
{
    protected $adminRepository;

    public function __construct(AdminRepository $repository)
    {
        $this->adminRepository = $repository;
    }

    public function updateAdmin($id, $data)
    {
        try {
            return $this->adminRepository->update($id, $data);
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return [
                    'status' => 'failed',
                    'message' => 'Email telah terdaftar pada akun lain'
                ];
            }
        }
    }
}
