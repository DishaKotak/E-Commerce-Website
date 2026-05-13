<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// All middleware imports
use App\Http\Middleware\AuthCustom;
use App\Http\Middleware\AdminMiddleware;

return Application::configure(basePath: dirname(__DIR__))

    // ---------------- ROUTES ----------------
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    // ---------------- MIDDLEWARE (ONLY ONE BLOCK) ----------------
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([

            // User / custom auth
            'authcustom' => AuthCustom::class,

            // Admin auth
            'admin'      => AdminMiddleware::class,

        ]);
    })

    // ---------------- EXCEPTIONS ----------------
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })

    ->create();
