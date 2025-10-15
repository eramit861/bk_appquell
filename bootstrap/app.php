<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
        then: function () {
            // Register additional route files
            Route::middleware('web')
                ->group(base_path('routes/auth.php'));
            
            Route::middleware('web')
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));
            
            Route::middleware('web')
                ->prefix('attorney')
                ->group(base_path('routes/attorney.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Register custom middleware aliases
        $middleware->alias([
            'is_admin' => \App\Http\Middleware\IsAdmin::class,
            'is_client' => \App\Http\Middleware\IsClient::class,
            'is_attorney' => \App\Http\Middleware\IsAttorney::class,
            'twofactor' => \App\Http\Middleware\TwoFactor::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
