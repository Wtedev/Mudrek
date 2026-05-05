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
        // Railway (and similar) terminate TLS at the edge and forward HTTP to the app with
        // X-Forwarded-Proto. Without trusting the proxy, Request::getScheme() stays "http",
        // so asset() / @vite() generate http:// URLs on an https page → mixed content → broken CSS/JS.
        $middleware->trustProxies(at: '*');

        $middleware->redirectGuestsTo(fn () => route('filament.admin.auth.login'));
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
