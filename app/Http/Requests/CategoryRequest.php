<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'name'=> 'required|min:3|max:150',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ];
    }

     // Custom error messages
    public function messages(): array
    {
        return [
            'name.required' => 'Please enter the category name.',
            'name.min' => 'Category name must be at least 3 characters long.',
            'name.max' => 'Category name must not be more than 150 characters long.',
            'image.required' => 'Please upload an image for the category.',
            'image.image' => 'Image must be a valid image file.',
            'image.mimes' => 'Image must be a file of type: jpg, jpeg, png, svg, and webp',
            'image.max' => 'Image must not be more than 2MB.',
        ];
    }
}
