<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'service.key' => \App\Http\Middleware\CheckServiceKey::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // this service is an API only, so always answer with JSON
        $exceptions->shouldRenderJsonWhen(fn () => true);
    })->create();
