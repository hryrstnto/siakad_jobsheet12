<?php
// NAMA    : HARY RISTANTO
// KELAS   : TIF-5C
// NIM     : 3202416102
use App\Http\Middleware\EnsureUserHasRole;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
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

// NAMA    : HARY RISTANTO
// KELAS   : TIF-5C
// NIM     : 3202416102
    ->withExceptions(function (Exceptions $exceptions): void {
        // semua error pada /api/* dijawab JSON, walau tanpa header Accept
        $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
            return $request->is('api/*') || $request->expectsJson();
        });

        // pesan 404 yang ringkas, tanpa membocorkan nama kelas model
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Data atau alamat tidak ditemukan.',
                ], 404);
            }
        });
    })->create();