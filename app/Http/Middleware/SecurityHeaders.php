<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Prevent MIME type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Prevent Clickjacking (allow from same origin)
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Enable Browser XSS filtering
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Control referrer information
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Enforce HTTPS (HSTS) - Only in production typically, but good to have prepared
        // if (app()->environment('production')) {
        //     $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        // }

        return $response;
    }
}
