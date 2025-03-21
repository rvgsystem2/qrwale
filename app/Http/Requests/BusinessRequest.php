<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessRequest extends FormRequest
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
            'bussiness_name' => 'required|string|max:255',
            'mobile_number' => 'nullable|digits_between:10,15',
            'website_url' => 'nullable|url',
            'fb_url' => 'nullable|url',
            'insta_url' => 'nullable|url',
            'linkden_url' => 'nullable|url',
            'watsapp_url' => 'nullable|url',
            'twiter_url' => 'nullable|url',
            'review_url' => 'nullable|url',
            'address' => 'nullable|string|max:500',
            'rating' => 'nullable|numeric|min:0|max:5',
            'logo_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_id' => 'nullable|exists:users,id', 
        ];
    }
}
