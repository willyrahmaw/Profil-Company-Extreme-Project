<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Only trust proxies running on this machine (ngrok agent / local reverse proxy).
        // Trusting '*' lets any client spoof its IP via X-Forwarded-For.
        $middleware->trustProxies(at: ['127.0.0.1', '::1']);

        // Apply security headers to all web responses
        $middleware->web(append: [
            \App\Http\Middleware\BlockBannedIp::class,
            \App\Http\Middleware\SecurityHeaders::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
