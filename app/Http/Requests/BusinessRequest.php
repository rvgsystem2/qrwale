<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
    $businessId = $this->route('business')?->id ?? null;
    return [
        'business_template_id' => ['required', Rule::exists('business_templates', 'id')->where('is_active', true)],
        'bussiness_name' => 'required|string|max:255',
        'mobile_number' => 'nullable|digits_between:10,15',
        'website_url' => 'nullable|url',
        'fb_url' => 'nullable|url',
        'insta_url' => 'nullable|url',
        'linkden_url' => 'nullable|url',
        'watsapp_url' => 'nullable|string|max:20',
        'twiter_url' => 'nullable|url',
        'review_url' => 'nullable|url',
        'email' => 'nullable|email|max:255',
        'tagline' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:2000',
        'business_category' => 'nullable|string|max:150',
        'contact_person' => 'nullable|string|max:150',
        'alternate_mobile' => 'nullable|string|max:20',
        'google_map_url' => 'nullable|url|max:2048',
        'youtube_url' => 'nullable|url|max:2048',
        'gstin' => 'nullable|string|max:30',
        'msme_number' => 'nullable|string|max:60',
        'opening_hours' => 'nullable|string|max:255',
        'custum_url' => [
            'nullable',
            'string',
            'max:255',
            'regex:/^[a-zA-Z0-9-_]+$/', // Only allows letters, numbers, dashes, and underscores
            Rule::unique('businesses', 'custum_url')->ignore($businessId),
        ],
        'address' => 'nullable|string|max:500',
        'rating' => 'nullable|numeric|min:0|max:5',
        'logo_img' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        'user_id' => 'nullable|exists:users,id',

    ];
}
public function messages(): array
{
    return [
        'custum_url.regex' => 'The custom URL can only contain letters, numbers, dashes, and underscores.',
        'custum_url.unique' => 'This custom URL is already taken. Please choose another.',
    ];
}



}
