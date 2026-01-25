<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Register Global Security Headers Middleware
        $middleware->append(\App\Http\Middleware\SecurityHeaders::class);
        $middleware->trustProxies(at: '*');

        $middleware->web(append: [
            \App\Http\Middleware\EnsureTwoFactorCodeIsPresent::class,
        ]);

        // Exclude PayHere webhook from CSRF protection
        $middleware->validateCsrfTokens(except: [
            'payment/notify',
            'payment/return'
        ]);

        // Register Admin.php (Middleware)
        $middleware->alias([
            'admin' => \App\Http\Middleware\Admin::class,
            'customer' => \App\Http\Middleware\Customer::class,
            'ability' => \Laravel\Sanctum\Http\Middleware\CheckAbilities::class,
            'abilities' => \Laravel\Sanctum\Http\Middleware\CheckForAnyAbility::class,
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        // Handle Validation Exceptions for API
        $exceptions->render(function (\Illuminate\Validation\ValidationException $e, \Illuminate\Http\Request $request) {
            if ($request->is('api/*')) {
                return \App\Helpers\ResponseHelper::error(
                    message: 'The given data was invalid.',
                    data: $e->errors(),
                    statusCode: 422
                );
            }
        });

        // Handle Authentication Exceptions for API
        $exceptions->render(function (\Illuminate\Auth\AuthenticationException $e, \Illuminate\Http\Request $request) {
            if ($request->is('api/*')) {
                return \App\Helpers\ResponseHelper::error(message: 'Unauthenticated.', statusCode: 401);
            }
        });

        // Handle Not Found Exceptions
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, \Illuminate\Http\Request $request) {
            if ($request->is('api/*')) {
                $previous = $e->getPrevious();
                if ($previous instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                    $model = class_basename($previous->getModel());
                    return \App\Helpers\ResponseHelper::error(message: $model . ' not found!', statusCode: 404);
                }
                return \App\Helpers\ResponseHelper::error(message: 'Resource not found!', statusCode: 404);
            }
        });
    })->create();
