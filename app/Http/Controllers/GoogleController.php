<?php

namespace App\Http\Controllers;

use App\Models\User;
// Used for try and catch
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    // When the log in with google button is clicked, it will direct the user to the google driver using socialite
    public function googlepage()
    {
        return Socialite::driver('google')
            // Profile: Gets first name, last name, and the profile picture
            // Email: Gets the email of the user
            ->scopes(['profile', 'email'])
            ->redirect();
    }

    public function googlecallback()
    {
        try {
            // Gets the account of the user using socialite
            $user = Socialite::driver('google')->user();
            // Finds the user in the database (User Table)
            // User table will try to find the google_id
            $finduser = User::where('google_id', $user->id)->first();
            // If user is found in the user table,
            if ($finduser) {

                Auth::login($finduser);
                // Then, send the user to the dashboard
                return redirect()->intended('/');

            }
            // However, if it is a first timer user, it will not find the user in the user table
            // It will add the user to the user table
            else {
                // Get the raw user data from Google's API response
                $googleUser = $user->user;
                // Extract first name from google's given_name field
                // However, if it is not available, make it null
                $firstName = $googleUser['given_name'] ?? null;
                // Extract last name from google's family_name field
                // However, if it is not available, make it null
                $lastName = $googleUser['family_name'] ?? null;
                // If google does not provide separate first name and last name
                // Split the full name
                if (!$firstName) {
                    // Split the name into two parts
                    $nameParts = explode(' ', $user->name, 2);
                    $firstName = $nameParts[0] ?? 'User';
                    $lastName = $nameParts[1] ?? '';
                }

                //Extract the username from email
                $username = explode('@', $user->email)[0];

                //Ensure that the username is unique in the database
                //If it exists, append a number
                $baseUsername = $username;
                $counter = 1;

                //Increment the counter until a unique username is found
                while (User::where('username', $username)->exists()) {
                    // Append the counter to the base username
                    $username = $baseUsername . $counter;
                    // Increment the counter for the next iteration
                    $counter++;
                }

                // Get the profile picture url from google

                $profilePhotoUrl = $user->avatar ?? null;

                // Create user in the database with all the extracted information
                $newUser = User::create([
                    // Google's given_name
                    'first_name' => $firstName,
                    // Google's family_name
                    'last_name' => $lastName ?? '',
                    // Google's profile picture url
                    'profile_photo_path' => $profilePhotoUrl,
                    // Extracted from the email
                    'username' => $username,
                    // Google's email address
                    'email' => $user->email,
                    // Unique user ID from Google
                    'google_id' => $user->id,
                    'password' => encrypt('123456dummy'),
                ]);

                Auth::login($newUser);
                // Then, it will direct the user to the dashboard
                return redirect()->intended('/');
            }

        }
        // If there is an exception, it will display the exception
        catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
