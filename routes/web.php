<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Dosen\AuthController as DosenAuthController;
use App\Http\Controllers\Mahasiswa\AuthController as MahasiswaAuthController;
use App\Http\Controllers\Mahasiswa\UserController;

Route::get('/', function () {
    $data = [
        'kepalaLab' => Setting::where('name', 'kepala_lab')->value('value'),
        'asisten1' => Setting::where('name', 'asisten1')->value('value'),
        'asisten2' => Setting::where('name', 'asisten2')->value('value'),
    ];

    return view('welcome', $data);
})->name('index');

Route::middleware(['guest', 'guest:admin', 'guest:dosen'])->group(function () {
    Route::get('/login', [MahasiswaAuthController::class, 'loginPage'])->name('login');
    Route::post('/login', [MahasiswaAuthController::class, 'login'])->name('authenticate');
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register', [UserController::class, 'store'])->name('register.store');

    Route::get('/dosen/login', [DosenAuthController::class, 'loginPage'])->name('dosen.login');
    Route::post('/dosen/login', [DosenAuthController::class, 'login'])->name('dosen.authenticate');

    Route::get('/admin/login', [AdminAuthController::class, 'loginPage'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.authenticate');
});

Route::group(['middleware' => 'ajax', 'prefix' => 'ajax', 'as' => 'ajax.'], function () {
    Route::get('/dosen', [AjaxController::class, 'dosen'])->name('dosen-praktikum');
});
