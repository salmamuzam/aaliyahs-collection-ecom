<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ResponseHelper;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\TwoFactorAuthenticationProvider;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        try {
            $data = $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'confirmed'],
            ]);

            $user = User::create(array_merge($data, [
                'password' => Hash::make($data['password']),
            ]));

            event(new Registered($user));

            return ResponseHelper::success(
                message: 'User registered successfully! Please verify your email.',
                data: new UserResource($user),
                statusCode: 201
            );
        } catch (Exception $e) {
            Log::error('Registration Error: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Registration failed!', statusCode: 500);
        }
    }

    /**
     * Login a user with Brute Force Protection and Multi-Device Support.
     */
    public function login(LoginRequest $request)
    {
        // Rate Limiting: Prevent Brute Force Attacks
        $throttleKey = strtolower((string) $request->input('login')) . '|' . $request->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return ResponseHelper::error(
                message: "Too many login attempts. Please try again in {$seconds} seconds.",
                statusCode: 429
            );
        }

        try {
            $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            $user = User::where((string) $fieldType, '=', (string) $request->login)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                RateLimiter::hit($throttleKey, 60);
                return ResponseHelper::error(message: 'Invalid credentials!', statusCode: 400);
            }

            RateLimiter::clear($throttleKey);

            if ($user->hasEnabledTwoFactorAuthentication()) {
                if ($request->input('two_factor_code')) {
                    $isValid = app(TwoFactorAuthenticationProvider::class)->verify(
                        decrypt($user->two_factor_secret),
                        (string) $request->input('two_factor_code')
                    );
                    if (!$isValid)
                        return ResponseHelper::error(message: 'Invalid Two-Factor Code!', statusCode: 400);
                } elseif ($request->input('two_factor_recovery_code')) {
                    $recoveryCode = (string) $request->input('two_factor_recovery_code');
                    $validCode = collect($user->recoveryCodes())->first(function ($code) use ($recoveryCode) {
                        return hash_equals($code, $recoveryCode) ? $code : null;
                    });
                    if ($validCode) {
                        $user->replaceRecoveryCode($validCode);
                    } else {
                        return ResponseHelper::error(message: 'Invalid Recovery Code!', statusCode: 400);
                    }
                } else {
                    return ResponseHelper::error(
                        message: 'Two-Factor Authentication Required',
                        data: ['two_factor_required' => true],
                        statusCode: 422
                    );
                }
            }

            // ASSIGN GRANULAR ABILITIES (Sanctum Mastery)
            $abilities = $user->user_type === 'admin' ? ['admin:access', 'customer:access'] : ['customer:access'];

            $token = $user->createToken('android-device', $abilities)->plainTextToken;

            return ResponseHelper::success(
                message: 'You are logged in successfully!',
                data: [
                    'user' => new UserResource($user),
                    'token' => $token
                ],
                statusCode: 200
            );
        } catch (Exception $e) {
            Log::error('Unable to login user: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to login! Please try again!', statusCode: 500);
        }
    }

    /**
     * Logout logic and Token Revocation
     */
    public function logout(Request $request)
    {
        try {
            if ($request->user()) {
                $request->user()->currentAccessToken()->delete();
                return ResponseHelper::success(message: 'Logged out successfully!', statusCode: 200);
            }
            return ResponseHelper::error(message: 'Not logged in!', statusCode: 401);
        } catch (Exception $e) {
            Log::error('Logout Failed: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Logout failed!', statusCode: 500);
        }
    }

    /**
     * Manage Active Devices (Sanctum Multi-Device Support)
     */
    public function getActiveTokens(Request $request)
    {
        $tokens = $request->user()->tokens->map(function ($token) use ($request) {
            return [
                'id' => $token->id,
                'name' => $token->name,
                'abilities' => $token->abilities,
                'last_used_at' => $token->last_used_at ? $token->last_used_at->diffForHumans() : 'Never',
                'created_at' => $token->created_at->toDateTimeString(),
                'is_current' => $token->id === $request->user()->currentAccessToken()->id
            ];
        });

        return ResponseHelper::success(message: 'Active devices fetched.', data: $tokens);
    }

    /**
     * Revoke a specific token (Security Enhancement)
     */
    public function revokeToken(Request $request, $tokenId)
    {
        $request->user()->tokens()->where('id', '=', $tokenId)->delete();
        return ResponseHelper::success(message: 'Device revoked successfully.');
    }

    /**
     * Forgot Password
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        try {
            $status = Password::sendResetLink($request->only('email'));
            return $status === Password::RESET_LINK_SENT
                ? ResponseHelper::success(message: __($status), statusCode: 200)
                : ResponseHelper::error(message: __($status), statusCode: 400);
        } catch (Exception $e) {
            Log::error('Forgot Password Error: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to send reset link!', statusCode: 500);
        }
    }

    /**
     * Reset Password
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill(['password' => Hash::make($password)])->setRememberToken(str()->random(60));
                    $user->save();
                    event(new \Illuminate\Auth\Events\PasswordReset($user));
                    $user->tokens()->delete();
                }
            );
            return $status === Password::PASSWORD_RESET
                ? ResponseHelper::success(message: __($status), statusCode: 200)
                : ResponseHelper::error(message: __($status), statusCode: 400);
        } catch (Exception $e) {
            Log::error('Reset Password Error: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to reset password!', statusCode: 500);
        }
    }

    /**
     * Verify Email
     */
    public function verifyEmail(Request $request, $id, $hash)
    {
        try {
            $user = User::find($id);
            if (!$user || !hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
                return ResponseHelper::error(message: 'Invalid link!', statusCode: 400);
            }
            if (!$user->hasVerifiedEmail()) {
                $user->markEmailAsVerified();
                event(new Verified($user));
            }
            return ResponseHelper::success(message: 'Email verified successfully!', statusCode: 200);
        } catch (Exception $e) {
            Log::error('Email Verify Error: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to verify email!', statusCode: 500);
        }
    }

    /**
     * Resend Verification Email
     */
    public function resendVerificationEmail(Request $request)
    {
        try {
            if ($request->user()->hasVerifiedEmail()) {
                return ResponseHelper::success(message: 'Already verified!', statusCode: 200);
            }
            $request->user()->sendEmailVerificationNotification();
            return ResponseHelper::success(message: 'Verification link sent successfully!', statusCode: 200);
        } catch (Exception $e) {
            Log::error('Resend Verify Error: ' . $e->getMessage());
            return ResponseHelper::error(message: 'Unable to send verification!', statusCode: 500);
        }
    }
}
