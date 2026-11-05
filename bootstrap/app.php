<?php
// NAMA    : HARY RISTANTO
// KELAS   : TIF-5C
// NIM     : 3202416102
use App\Http\Middleware\EnsureUserHasRole;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Tamu yang membuka halaman terlindungi dialihkan ke sini
        $middleware->redirectGuestsTo(fn () => route('login'));

        // Pengguna login yang membuka halaman khusus tamu dialihkan ke sini
        $middleware->redirectUsersTo(fn () => route('dashboard'));

        // Mendaftarkan alias middleware role
        $middleware->alias([
            'role' => EnsureUserHasRole::class,
        ]);
    })

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'nocache' => \App\Http\Middleware\NoCache::class,
        ]);
    })
    
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
