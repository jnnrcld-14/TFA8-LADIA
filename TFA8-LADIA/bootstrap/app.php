<?php

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
        // The `auth` and `guest` aliases are registered by the framework.
        // Unauthenticated users are redirected to the route named "login".
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
