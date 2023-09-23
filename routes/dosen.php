<?php

use App\Http\Controllers\Dosen\AuthController;
use App\Http\Controllers\Dosen\DashboardController;
use App\Http\Controllers\Dosen\PraktikumController;
use App\Http\Controllers\Dosen\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:dosen', 'as' => 'dosen.'], function () {
    Route::get('/', function () {
        return redirect()->route('dosen.dashboard');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/praktikum', [PraktikumController::class, 'index'])->name('praktikum');
    Route::get('/praktikum/{id}/mahasiswa', [PraktikumController::class, 'mahasiswa'])->name('praktikum.mahasiswa');
    Route::get('/praktikum/{id}/slip', [PraktikumController::class, 'slip'])->name('praktikum.slip');
    Route::get('/praktikum/{id}/slip/export', [PraktikumController::class, 'slipExport'])->name('praktikum.slip-export');

    Route::get('/profil', [ProfileController::class, 'edit'])->name('profil');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profil-update');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
