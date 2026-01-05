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
        $middleware->web(append: [
            \App\Http\Middleware\EnsureTwoFactorCodeIsPresent::class,
        ]);

        // Register Admin.php (Middleware)
        $middleware->alias([
            'admin' => \App\Http\Middleware\Admin::class,
            'customer' => \App\Http\Middleware\Customer::class,
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        // Handle model not found exceptions
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, \Illuminate\Http\Request $request) {
            if ($request->is('api/*')) {
                // Check if it's a model not found error
                $previous = $e->getPrevious();
                if ($previous instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                    $model = class_basename($previous->getModel());
                    return \App\Helpers\ResponseHelper::error(message: $model . ' not found!', statusCode: 404);
                }
                // Generic 404 for other cases
                return \App\Helpers\ResponseHelper::error(message: 'Resource not found!', statusCode: 404);
            }
        });
    })->create();
