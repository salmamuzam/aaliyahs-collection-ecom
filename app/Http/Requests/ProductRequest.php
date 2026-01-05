<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|min:3|max:50',
            'description' => 'required|min:10',
            'price' => 'required|numeric|min:1000|max:100000',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter a product name.',
            'name.min' => 'Product name must be at least 3 characters long!',
            'name.max' => 'Product name must not be more than 50 characters long!',
            'description.required' => 'Please enter a product description!',
            'description.min' => 'Product description must be at least 10 characters long!',
            'price.required' => 'Please enter the product price!',
            'price.numeric' => 'Product price must be a numeric value!',
            'price.min' => 'Product price must be at least 1,000!',
            'price.max' => 'Product price must not exceed 100,000!',
            'images.required' => 'Please upload at least one image!',
            'images.min' => 'Please upload at least one image!',
            'images.*.image' => 'Image must be a valid image file!',
            'images.*.mimes' => 'Image must be a file of type: jpeg, png, jpg, svg, webp!',
            'images.*.max' => 'Image must not be more than 2MB!',
        ];
    }
}
