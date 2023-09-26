<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mahasiswa\AuthController;
use App\Http\Controllers\Mahasiswa\PagesController;
use App\Http\Controllers\Asisten\MahasiswaController;
use App\Http\Controllers\Mahasiswa\ProfileController;
use App\Http\Controllers\Mahasiswa\PraktikumController;
use App\Http\Controllers\Asisten\SlipPraktikumController;
use App\Http\Controllers\Mahasiswa\BebasLabController;
use App\Http\Controllers\Mahasiswa\PasswordController;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [PagesController::class, 'dashboard'])->name('dashboard');

    // Asisten
    Route::middleware("asisten")->as("asisten.")->group(function() {
        Route::get('/asisten/mahasiswa', [MahasiswaController::class, 'show'])->name('daftar-mahasiswa');

        Route::get('/asisten/mahasiswa/{id}', [MahasiswaController::class, 'detail'])->name('mahasiswa-detail');
        Route::get('/asisten/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa-edit');
        Route::put('/asisten/mahasiswa/{id}/update', [MahasiswaController::class, 'update'])->name('mahasiswa-update');
        Route::post('/asisten/mahasiswa/{action}', [MahasiswaController::class, 'action'])->name('mahasiswa-action');

        Route::get('/asisten/slip', [SlipPraktikumController::class, 'show'])->name('slip');
    });

    // Informasi
    Route::get('/informasi', [PagesController::class, 'informasi'])->name('informasi');

    // Slip Praktikum
    Route::get('/slip', [PagesController::class, 'slip'])->name('slip');

    Route::post('/slip', [PraktikumController::class, 'tambahPraktikum'])->name('tambah-praktikum');
    Route::delete('/slip', [PraktikumController::class, 'hapusPraktikum'])->name('hapus-praktikum');

    // Bebas Lab
    Route::get('/bebas-lab', [BebasLabController::class, 'index'])->name('bebas-lab');
    Route::get('/bebas-lab/upload', [BebasLabController::class, 'upload'])->name('bebas-lab.upload');
    Route::post('/bebas-lab/upload', [BebasLabController::class, 'store'])->name('bebas-lab.store');

    // Akun
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profil');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profil-update');

    Route::get('/new-password', [PasswordController::class, 'index'])->name('password');
    Route::put('/new-password', [PasswordController::class, 'update'])->name('password.update');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
