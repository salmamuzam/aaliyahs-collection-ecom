<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'google_id',
        'password',
        'profile_photo_path',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected function email(): Attribute
    {
        return Attribute::make(set: fn($v) => strtolower($v));
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(get: fn() => "{$this->first_name} {$this->last_name}");
    }

    protected function name(): Attribute
    {
        return Attribute::make(get: fn() => "{$this->first_name} {$this->last_name}");
    }

    /**
     * ADVANCED: Virtual attribute for initials (Innovation)
     */
    protected function initials(): Attribute
    {
        return Attribute::make(
            get: fn() => strtoupper(substr((string) $this->first_name, 0, 1) . substr((string) ($this->last_name ?? ''), 0, 1))
        );
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Update the user's profile photo.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @param  string  $storagePath
     * @return void
     */
    public function updateProfilePhoto(\Illuminate\Http\UploadedFile $photo, $storagePath = 'profile-photos')
    {
        $url = \App\Helpers\CloudinaryHelper::upload($photo, 'profiles');

        if ($url) {
            $this->forceFill([
                'profile_photo_path' => $url,
            ])->save();
        }
    }

    /**
     * Delete the user's profile photo.
     *
     * @return void
     */
    public function deleteProfilePhoto()
    {
        $this->forceFill([
            'profile_photo_path' => null,
        ])->save();
    }

    /**
     * Get the URL to the user's profile photo.
     *
     * @return string
     */
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo_path) {
            if (str_starts_with($this->profile_photo_path, 'http')) {
                return $this->profile_photo_path;
            }
            return \Illuminate\Support\Facades\Storage::disk($this->profilePhotoDisk())->url($this->profile_photo_path);
        }

        return $this->defaultProfilePhotoUrl();
    }
}
