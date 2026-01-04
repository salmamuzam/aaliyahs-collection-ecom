<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Enable
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Validation rules
            'first_name' => 'required|min:5|max:150',
            'last_name' => 'required|min:5|max:150',
            'username' => 'required|min:5|max:150|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:25|confirmed',
        ];
    }

    public function messages()
    {
        return [
            // Custom error messages
            'first_name.required' => 'Please enter your first name',
            'first_name.min' => 'First name must be at least 5 characters long',
            'first_name.max' => 'First name must not be more than 150 characters long',
            'last_name.required' => 'Please enter your last name',
            'last_name.min' => 'Last name must be at least 5 characters long',
            'last_name.max' => 'Last name must not be more than 150 characters long',
            'username.required' => 'Please enter a username',
            'username.min' => 'Username must be at least 5 characters long',
            'username.max' => 'Username must not be more than 150 characters long',
            'username.unique' => 'Username is already taken, please choose another one',
            'email.required' => 'Please enter your email address',
            'email.email' => 'Email must be a valid email address',
            'email.unique' => 'Email is already taken, please use a different one',
            'password.required' => 'Please enter a password',
            'password.min' => 'Password must be at least 5 characters long',
            'password.max' => 'Password must not be more than 25 characters long',
            'password.confirmed' => 'Password confirmation does not match',
        ];
    }
}
