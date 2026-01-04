<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ResponseHelper;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    /**
     * Register a new user.
     */
    public function register(RegisterRequest $request)
    {
        try {
            // Insert user record in user table
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($user) {
                // Success
                return ResponseHelper::success(message: 'User has been registered successfully!', data: $user, statusCode: 201);
            }
            return ResponseHelper::error(message: 'Unable to register user! Please try again!', statusCode: 500);
        } catch (Exception $e) {
            Log::error('Unable to register user: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to register user! Please try again!', statusCode: 500);
        }
    }

    /**
     * Login a user.
     */
    public function login(LoginRequest $request)
    {
        try {
            // Validate whether credentials are correct or not
            $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            if (!Auth::attempt([$fieldType => $request->login, 'password' => $request->password])) {
                return ResponseHelper::error(message: 'Unable to login due to invalid credentials', statusCode: 400);
            }
            // If credentials are correct, return user data
            $user = Auth::user();
            // Create API token
            $token = $user->createToken('My API Token')->plainTextToken;
            $authUser = [
                'user' => $user,
                'token' => $token,
            ];
            return ResponseHelper::success(message: 'You are logged in successfully!', data: $authUser, statusCode: 200);
        } catch (Exception $e) {
            Log::error('Unable to login user: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to login! Please try again!', statusCode: 500);
        }
    }

    // Fetch profile data

    public function userProfile()
    {
        try {
            $user = Auth::user();
            if ($user) {
                return ResponseHelper::success(message: 'User profile data fetched successfully', data: $user, statusCode: 200);
            }
            return ResponseHelper::error(message: 'Unable to fetch user data due to invalid token', statusCode: 400);
        } catch (Exception $e) {
            Log::error('Unable to fetch user profile: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to fetch user profile! Please try again!', statusCode: 500);
        }
    }

    // Logout

    public function logout()
    {
        try {
            $user = Auth::user();
            if ($user) {
                $user->currentAccessToken()->delete();
                return ResponseHelper::success(message: 'You have been logged out successfully!', statusCode: 200);
            }
            return ResponseHelper::success(message: 'Unable to logout due to invalid token', statusCode: 200);
        } catch (Exception $e) {
            Log::error('Unable to logout due to some exception: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to logout! Please try again!', statusCode: 500);
        }
    }
}
