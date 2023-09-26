<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BebasLabController;
use App\Http\Controllers\API\InformasiController;
use App\Http\Controllers\API\PasswordController;
use App\Http\Controllers\API\PraktikumController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\SlipPraktikumController;
use App\Http\Controllers\API\UploadBerkasController;

Route::get('/data', [ApiController::class, 'data']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/me', function(Request $request) {
        return response()->json([
            'user' => $request->user()
        ]);
    });

    Route::put('/update-pass', [PasswordController::class, 'updatePassword']);

    Route::get('/informasi', [InformasiController::class, 'daftarInformasi']);

    Route::get('/praktikum/{jenis?}', [PraktikumController::class, 'daftarPraktikum']);
    Route::post('/praktikum', [PraktikumController::class, 'tambahPraktikum']);
    Route::delete('/praktikum', [PraktikumController::class, 'hapusPraktikum']);

    Route::post('/slip', [SlipPraktikumController::class, 'store']);

    Route::get('/bebas-lab', [BebasLabController::class, 'get']);
    Route::post('/bebas-lab', [BebasLabController::class, 'store']);

    Route::get('/logout', [AuthController::class, 'logout']);
});
