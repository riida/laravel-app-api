<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // 特定位置にmiddlewareを入れるため完全に再定義
        $middleware->group('web', [
            Illuminate\Cookie\Middleware\EncryptCookies::class,
            Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            Illuminate\Session\Middleware\StartSession::class,
            Illuminate\View\Middleware\ShareErrorsFromSession::class,
            App\Http\Middleware\RequestLogger::class,
            Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
            Illuminate\Routing\Middleware\SubstituteBindings::class,
            Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
        ]);
        $middleware->web(
            append: [
        ],
            prepend:[
        ],
            remove: [
            // ValidateCsrfToken::class,
        ]
        );

        $middleware->api(
            prepend: [
            Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]
        );

        $middleware->encryptCookies(except: [
            // 'laravel_session',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
