<?php

use App\Http\Middleware\AdminAuthMiddlewere;
use App\Http\Middleware\SessionInactivityTimeout;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
     ->withMiddleware(function (Middleware $middleware) {
        // Register route middleware
        $middleware->alias([
            'adminauth' => AdminAuthMiddlewere::class,
            'session.inactivity' => SessionInactivityTimeout::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
