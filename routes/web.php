<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\krsController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn()=>redirect()->route('dashboard'));

Route::get('/dashboard', [DashboardController::class, 'index']) ->name('dashboard');


Route::get ('/beranda', [BerandaController::class, 'index']) ->name('Beranda');
Route::get ('/mahasiswa', [MahasiswaController::class, 'index']) ->name('mahasiswa.index');
Route::get ('/dosen', [DosenController::class, 'index']) ->name('dosen.index');
Route::get ('/matakuliah', [MatakuliahController::class, 'index']) ->name('matakuliah.index');
Route::get ('/krs', [krsController::class, 'index']) ->name('krs.index');

// Dari Jobsheet 07, tetap dipertahankan
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');