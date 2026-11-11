<?php

// NAMA    : HARY RISTANTO
// KELAS   : TIF-5C
// NIM     : 3202416102
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DosenController;
use Illuminate\Support\Facades\Route;

// Semua route di berkas ini otomatis berawalan /api (bootstrap/app.php)
Route::prefix('v1')->name('api.v1.')->group(function () {

    // 1) Publik: hanya login, maksimal 5 percobaan per menit per IP
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login');

    // 2) Wajib token Sanctum
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [AuthController::class, 'me'])->name('me');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // baca: semua pengguna yang punya token
        Route::apiResource('dosen', DosenController::class)
            ->only(['index', 'show']);

        // tulis: khusus admin (middleware role dari Jobsheet 10)
        Route::middleware('role:admin')->group(function () {
            Route::apiResource('dosen', DosenController::class)
                ->except(['index', 'show']);
        });
    });
});
