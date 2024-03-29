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

Route::middleware('api_key')->group(function () {
    Route::get('/data', [ApiController::class, 'data']);

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [RegisterController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', function (Request $request) {
            return response()->json([
                'user' => $request->user()
            ]);
        });

        Route::put('/update-pass', [PasswordController::class, 'updatePassword']);

        Route::get('/informasi', [InformasiController::class, 'get']);

        Route::get('/praktikum', [PraktikumController::class, 'get']);
        Route::post('/praktikum', [PraktikumController::class, 'store']);
        Route::delete('/praktikum', [PraktikumController::class, 'delete']);

        Route::get('/slip', [SlipPraktikumController::class, 'get']);
        Route::post('/slip', [SlipPraktikumController::class, 'store']);

        Route::get('/bebas-lab', [BebasLabController::class, 'get']);
        Route::post('/bebas-lab', [BebasLabController::class, 'store']);

        Route::get('/logout', [AuthController::class, 'logout']);
    });
});
