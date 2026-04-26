<?php

use App\Http\Middleware\AutenticacaoMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\LogAcessoMiddleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Grupo web
        $middleware->appendToGroup('web', [
            LogAcessoMiddleware::class,
        ]);

        // Alias
        $middleware->alias([
            'log.acesso' => LogAcessoMiddleware::class,
            'autenticacao' => AutenticacaoMiddleware::class,
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
