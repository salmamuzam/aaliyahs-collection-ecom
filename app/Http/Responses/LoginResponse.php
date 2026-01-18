<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $user = Auth::user();

        // INNOVATIVE: Intelligent Redirection based on Role (UX Optimization)
        if ($user->user_type === 'admin') {
            return redirect()->route('admin.overview');
        }

        // Standard customers go to the store front
        return redirect()->intended('/');
    }
}
