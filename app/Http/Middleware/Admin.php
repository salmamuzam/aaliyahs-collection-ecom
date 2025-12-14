<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
// Checks whether the user is logged in
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Auth: Checks whether the user is logged in
        // If the user_type is admin, proceed with the request
        if(Auth::user()->user_type == 'admin'){
            return $next($request);
        }

        else{
        // However, if the user_type is not admin, display unauthorized access message
            // abort(401);
        // Send the user to the home page
            return redirect ('/');
        }
    }
}
