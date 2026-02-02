<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateTokenRequest;
use Exception;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Laravel\Fortify\Actions\GenerateNewRecoveryCodes;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    // ============================================
    // Profile Management
    // ============================================
    public function userProfile()
    {
        try {
            return ResponseHelper::success(message: 'User profile fetched successfully!', data: new UserResource(Auth::user()), statusCode: 200);
        } catch (Exception $e) {
            Log::error('Unable to fetch user profile: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to fetch user profile! Please try again!', statusCode: 500);
        }
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        try {
            $user = Auth::user();
            $user->update($request->validated());
            if ($request->hasFile('photo')) {
                $user->updateProfilePhoto($request->file('photo'));
            }
            return ResponseHelper::success(message: 'Profile updated successfully!', data: new UserResource($user), statusCode: 200);
        } catch (Exception $e) {
            Log::error('Unable to update profile: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to update profile! Please try again!', statusCode: 500);
        }
    }

    public function deleteProfilePhoto()
    {
        try {
            Auth::user()->deleteProfilePhoto();
            return ResponseHelper::success(message: 'Profile photo deleted successfully!', statusCode: 200);
        } catch (Exception $e) {
            Log::error('Unable to delete profile photo: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to delete profile photo! Please try again!', statusCode: 500);
        }
    }

    public function deleteAccount(Request $request)
    {
        try {
            $user = Auth::user();
            $user->currentAccessToken()->delete();
            $user->delete();
            return ResponseHelper::success(message: 'Account deleted successfully!', statusCode: 200);
        } catch (Exception $e) {
            Log::error('Unable to delete account: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to delete account! Please try again!', statusCode: 500);
        }
    }

    // ============================================
    // Password Management
    // ============================================
    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $user = Auth::user();
            if (!Hash::check($request->current_password, $user->password)) {
                return ResponseHelper::error(message: 'Current password does not match!', statusCode: 400);
            }
            $user->update(['password' => Hash::make($request->password)]);
            return ResponseHelper::success(message: 'Password changed successfully!', statusCode: 200);
        } catch (Exception $e) {
            Log::error('Unable to change password: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to change password! Please try again!', statusCode: 500);
        }
    }

    public function confirmPassword(Request $request)
    {
        try {
            if (!Hash::check($request->password, Auth::user()->password)) {
                return ResponseHelper::error(message: 'Password confirmation failed!', statusCode: 400);
            }
            return ResponseHelper::success(message: 'Password confirmed successfully!', statusCode: 200);
        } catch (Exception $e) {
            Log::error('Error confirming password: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Error confirming password! Please try again!', statusCode: 500);
        }
    }

    // ============================================
    // 2FA Management
    // ============================================
    public function enableTwoFactor(Request $request)
    {
        try {
            $user = $request->user();

            // API Security: Manually verify password since session-based confirmation doesn't work for stateless APIs
            if (!$request->has('current_password') || !Hash::check($request->current_password, $user->password)) {
                return ResponseHelper::error(message: 'Current password is required and must be valid to enable 2FA.', statusCode: 400);
            }

            app(EnableTwoFactorAuthentication::class)($user);

            $user->refresh();

            return ResponseHelper::success(message: '2FA Enabled successfully!', data: [
                'svg' => $user->twoFactorQrCodeSvg(), // Note: Requires 'bacon/bacon-qr-code'
                'recovery_codes' => $user->recoveryCodes(),
            ], statusCode: 200);
        } catch (Exception $e) {
            Log::error('2FA Enablement Error: ' . $e->getMessage() . ' at ' . $e->getFile() . ':' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to enable 2FA: ' . $e->getMessage(), statusCode: 500);
        }
    }

    public function disableTwoFactor(Request $request)
    {
        try {
            app(DisableTwoFactorAuthentication::class)($request->user());
            return ResponseHelper::success(message: '2FA Disabled successfully!', statusCode: 200);
        } catch (Exception $e) {
            Log::error('Unable to disable 2FA: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to disable 2FA! Please try again!', statusCode: 500);
        }
    }

    public function getTwoFactorQrCode(Request $request)
    {
        try {
            $user = $request->user();
            if (!$user->hasEnabledTwoFactorAuthentication())
                return ResponseHelper::error(message: '2FA not enabled!', statusCode: 400);
            return ResponseHelper::success(message: 'QR Code fetched successfully!', data: ['svg' => $user->twoFactorQrCodeSvg()], statusCode: 200);
        } catch (Exception $e) {
            Log::error('Unable to get QR Code: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to get QR Code! Please try again!', statusCode: 500);
        }
    }

    public function getRecoveryCodes(Request $request)
    {
        try {
            $user = $request->user();
            if (!$user->hasEnabledTwoFactorAuthentication())
                return ResponseHelper::error(message: '2FA not enabled!', statusCode: 400);
            return ResponseHelper::success(message: 'Recovery Codes fetched successfully!', data: $user->recoveryCodes(), statusCode: 200);
        } catch (Exception $e) {
            Log::error('Error fetching codes: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Error fetching codes! Please try again!', statusCode: 500);
        }
    }

    public function regenerateRecoveryCodes(Request $request)
    {
        try {
            $user = $request->user();
            if (!$user->hasEnabledTwoFactorAuthentication())
                return ResponseHelper::error(message: '2FA not enabled!', statusCode: 400);
            app(GenerateNewRecoveryCodes::class)($user);
            return ResponseHelper::success(message: 'Codes Regenerated successfully!', data: $user->recoveryCodes(), statusCode: 200);
        } catch (Exception $e) {
            Log::error('Error regenerating codes: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Error regenerating codes! Please try again!', statusCode: 500);
        }
    }

    // ============================================
    // Session / Token Management
    // ============================================
    public function revokeOtherTokens(Request $request)
    {
        try {
            $user = Auth::user();
            $user->tokens()->where('id', '!=', $user->currentAccessToken()->id)->delete();
            return ResponseHelper::success(message: 'Other sessions revoked successfully!', statusCode: 200);
        } catch (Exception $e) {
            Log::error('Revocation failed: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Revocation failed! Please try again!', statusCode: 500);
        }
    }

    public function getUserTokens(Request $request)
    {
        try {
            return ResponseHelper::success(message: 'Tokens fetched successfully!', data: $request->user()->tokens, statusCode: 200);
        } catch (Exception $e) {
            Log::error('Unable to fetch tokens: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to fetch tokens! Please try again!', statusCode: 500);
        }
    }

    public function createUserToken(CreateTokenRequest $request)
    {
        try {
            // Validation handled by FormRequest
            $token = $request->user()->createToken($request->name)->plainTextToken;
            return ResponseHelper::success(message: 'Token created successfully!', data: ['token' => $token], statusCode: 201);
        } catch (Exception $e) {
            Log::error('Unable to create token: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to create token! Please try again!', statusCode: 500);
        }
    }

    public function deleteUserToken(Request $request, $tokenId)
    {
        try {
            $request->user()->tokens()->where('id', $tokenId)->delete();
            return ResponseHelper::success(message: 'Token deleted successfully!', statusCode: 200);
        } catch (Exception $e) {
            Log::error('Unable to delete token: ' . $e->getMessage() . '-Line No: ' . $e->getLine());
            return ResponseHelper::error(message: 'Unable to delete token! Please try again!', statusCode: 500);
        }
    }
}
