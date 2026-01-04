<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());

        // Check if the input is an email, otherwise treat it as a username
        $field = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Attempt login with the correct column ('email' or 'username')
        if (!Auth::attempt([$field => $request->login, 'password' => $request->password])) {
            return $this->error('', 'Credentials do not match', 401);
        }

        $user = User::where($field, $request->login)->first();

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of ' . $user->username)->plainTextToken
        ]);
    }

    public function register(StoreUserRequest $request)
    {
        $request->validated($request->all());
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of ' . $user->username)->plainTextToken,
        ]);
    }

    public function logout()
    {
        return response()->json('This is my logout method');
    }
}
