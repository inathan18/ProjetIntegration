<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\EnsureEmailIsNotVerified;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo('/fournisseur/connexion');
        $middleware->append(EnsureEmailIsNotVerified::class);
       /* $middleware->web(append: [
            CheckRole::class,
        ]);*/
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
