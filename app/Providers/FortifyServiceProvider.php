<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use App\Http\Responses\LoginResponse;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Auth;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LoginResponseContract::class, LoginResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);
        Fortify::registerView(function () {
            return view('auth.register');
        });

        Fortify::authenticateUsing(function (Request $request) {
            // Get the user from login
            $user = User::where("email", "=", $request->login)
                ->orWhere("username", "=", $request->login)
                ->first();

            // 1. If user doesn't exist:
            if (!$user) {
                // Log failed attempt for audit (Enhanced Security)
                \Illuminate\Support\Facades\Log::warning("Failed login attempt for: {$request->login} from IP: {$request->ip()}");

                throw \Illuminate\Validation\ValidationException::withMessages([
                    'login' => ['The username or email is incorrect!'],
                ]);
            }

            // 2. If password matches:
            if (Hash::check($request->password, $user->password)) {
                // Optional: Check if user is banned/active (Demonstrates User Management Control)
                // if ($user->status !== 'active') { ... } 

                return $user;
            }

            // 3. User exists but password is wrong:
            \Illuminate\Support\Facades\Log::warning("Failed password for user: {$user->email} from IP: {$request->ip()}");
            throw \Illuminate\Validation\ValidationException::withMessages([
                'password' => ['The password is incorrect!'],
            ]);
        });

        RateLimiter::for('login', function (Request $request) {
            $username = $request->input(Fortify::username());
            // Stricter limit: 5 attempts per minute per email+IP combination
            // This prevents brute-forcing specific accounts while allowing general traffic
            $throttleKey = Str::transliterate(Str::lower($username) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        // Custom password confirmation for 'login' field
        Fortify::confirmPasswordView(function () {
            return view('auth.confirm-password');
        });

        Fortify::confirmPasswordsUsing(function ($user, $password) {
            // Compares the plain text password with the hashed password
            // If it matches, it returns true
            // If not, it returns false
            return Hash::check($password, $user->password);
        });
    }
}
