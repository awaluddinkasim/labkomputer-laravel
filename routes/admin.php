<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BebasLabController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\ProdiController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\FakultasController;
use App\Http\Controllers\Admin\InformasiController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\PraktikumController;
use App\Http\Controllers\Admin\SlipPraktikumController;

Route::group(['middleware' => 'auth:admin', 'as' => 'admin.'], function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/dashboard', [PagesController::class, 'dashboard'])->name('dashboard');

    // Informasi
    Route::get('/informasi', [InformasiController::class, 'get'])->name('informasi');
    Route::post('/informasi', [InformasiController::class, 'informasiStore'])->name('informasi-store');
    Route::put('/informasi/update', [InformasiController::class, 'informasiUpdate'])->name('informasi-update');
    Route::delete('/informasi', [InformasiController::class, 'informasiDelete'])->name('informasi-delete');

    // Master Data
    Route::get('/master/{jenis}', [PagesController::class, 'masterData'])->name('master');

    Route::post('/master/fakultas', [FakultasController::class, 'store'])->name('fakultas-store');
    Route::delete('/master/fakultas', [FakultasController::class, 'delete'])->name('fakultas-delete');
    Route::get('/master/fakultas/edit', [FakultasController::class, 'edit'])->name('fakultas-edit');
    Route::put('/master/fakultas/update', [FakultasController::class, 'update'])->name('fakultas-update');

    Route::post('/master/prodi', [ProdiController::class, 'store'])->name('prodi-store');
    Route::delete('/master/prodi', [ProdiController::class, 'delete'])->name('prodi-delete');
    Route::get('/master/prodi/edit', [ProdiController::class, 'edit'])->name('prodi-edit');
    Route::put('/master/prodi/update', [ProdiController::class, 'update'])->name('prodi-update');

    Route::post('/master/praktikum', [PraktikumController::class, 'store'])->name('praktikum-store');
    Route::delete('/master/praktikum', [PraktikumController::class, 'delete'])->name('praktikum-delete');
    Route::get('/master/praktikum/edit', [PraktikumController::class, 'edit'])->name('praktikum-edit');
    Route::put('/master/praktikum/update', [PraktikumController::class, 'update'])->name('praktikum-update');

    // Akun
    Route::get('/akun/{jenis}', [PagesController::class, 'akun'])->name('akun');

    Route::post('/akun/dosen', [DosenController::class, 'store'])->name('dosen-store');
    Route::get('/akun/dosen/{id}', [DosenController::class, 'detail'])->name('dosen-detail');
    Route::get('/akun/dosen/{id}/edit', [DosenController::class, 'edit'])->name('dosen-edit');
    Route::put('/akun/dosen/{id}/edit', [DosenController::class, 'update'])->name('dosen-update');
    Route::delete('/akun/dosen', [DosenController::class, 'delete'])->name('dosen-delete');

    Route::post('/akun/dosen/{id}', [DosenController::class, 'storePraktikum'])->name('dosen-praktikum');
    Route::delete('/akun/dosen/{id}', [DosenController::class, 'deletePraktikum'])->name('dosen-praktikum-delete');

    Route::get('/akun/mahasiswa/{id}', [MahasiswaController::class, 'detail'])->name('mhs-detail');
    Route::get('/akun/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mhs-edit');
    Route::put('/akun/mahasiswa/{id}/update', [MahasiswaController::class, 'update'])->name('mhs-update');
    Route::post('/akun/mahasiswa/{action}', [MahasiswaController::class, 'action'])->name('mhs-action');
    Route::delete('/akun/mahasiswa', [MahasiswaController::class, 'delete'])->name('mhs-delete');

    // Slip Praktikum
    Route::get('/slip', [SlipPraktikumController::class, 'slipPraktikum'])->name('slip');
    Route::get('/slip/export', [SlipPraktikumController::class, 'slipPraktikumExport'])->name('slip-export');

    // Bebas Lab
    Route::get('/bebas-lab/{status}', [BebasLabController::class, 'bebasLab'])->name('bebas-lab');

    // Pengaturan
    Route::post('/pengaturan', [PengaturanController::class, 'save'])->name('pengaturan-save');

    // Akun
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profil');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profil-update');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
