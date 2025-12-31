<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTwoFactorCodeIsPresent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check for specific route name used by Fortify for post submission
        if ($request->isMethod('POST') && ($request->routeIs('two-factor.login.store') || $request->routeIs('two-factor.login'))) {
            $request->validate([
                'code' => 'required_without:recovery_code',
                'recovery_code' => 'required_without:code',
            ], [
                'code.required_without' => 'The code field is required.',
                'recovery_code.required_without' => 'The recovery code field is required.',
            ]);
        }

        return $next($request);
    }
}
