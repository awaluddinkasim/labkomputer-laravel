<?php

namespace App\Http\Services;

use Illuminate\Database\QueryException;
use App\Http\Repositories\MahasiswaRepository;

class MahasiswaService
{
    protected $mahasiswaRepository;

    public function __construct(MahasiswaRepository $repository)
    {
        $this->mahasiswaRepository = $repository;
    }

    public function getAllMahasiswa($except = null)
    {
        return $this->mahasiswaRepository->get($except);
    }

    public function getMahasiswaActive()
    {
        return $this->mahasiswaRepository->getActive();
    }

    public function getMahasiswaById($id)
    {
        return $this->mahasiswaRepository->getById($id);
    }

    public function verifikasiMahasiswa($id)
    {
        try {
            $result = $this->mahasiswaRepository->verifikasi($id);

            return $result;
        } catch (\Throwable $th) {
            return [
                'status' => 'failed',
                'message' => 'Terjadi kesalahan'
            ];
        }
    }

    public function tolakMahasiswa($id)
    {
        try {
            $result = $this->mahasiswaRepository->tolak($id);

            return $result;
        } catch (\Throwable $th) {
            return [
                'status' => 'failed',
                'message' => 'Terjadi kesalahan'
            ];
        }
    }

    public function storeData($data)
    {
        try {
            $result = $this->mahasiswaRepository->store($data);

            return $result;
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return [
                    'status' => 'failed',
                    'message' => 'Gagal, Akun dengan NIM tersebut sudah terdaftar',
                ];
            }
            return [
                'status' => 'failed',
                'message' => 'Terjadi kesalahan',
            ];
        }
    }

    public function updateData($data, $id, $isAdmin = false)
    {
        try {
            $result = $this->mahasiswaRepository->update($data, $id, $isAdmin);

            return $result;
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return [
                    'status' => 'failed',
                    'message' => 'Gagal, Akun dengan NIM tersebut sudah terdaftar',
                ];
            }
            return [
                'status' => 'failed',
                'message' => 'Terjadi kesalahan',
            ];
        }
    }

    public function deleteData($id)
    {
        $result = $this->mahasiswaRepository->destroy($id);

        return $result;
    }

    public function updatePasswordMahasiswa($id, $data)
    {
        try {
            return $this->mahasiswaRepository->updatePassword($id, $data);
        } catch (\Throwable $th) {
            return [
                'status' => 'failed',
                'message' => 'Terjadi kesalahan',
            ];
        }
    }
}
