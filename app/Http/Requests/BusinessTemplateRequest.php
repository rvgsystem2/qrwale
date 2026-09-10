<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BusinessTemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasRole('Super Admin');
    }
    public function rules(): array
    {
        $id = $this->route('businessTemplate')?->id;
        return [
            'name' => ['required', 'string', 'max:100'],
            'slug' => ['required', 'string', 'max:100', 'regex:/^[a-z0-9-]+$/', Rule::unique('business_templates')->ignore($id)],
            'layout' => ['required', Rule::in(['split', 'centered', 'banner'])],
            'card_style' => ['required', Rule::in(['soft', 'bordered', 'glass'])],
            'primary_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'secondary_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'accent_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'background_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'is_active' => ['nullable', 'boolean'],
            'is_default' => ['nullable', 'boolean'],
            'view_key' => [
                'nullable',
                'string',
                Rule::in(
                    array_keys(
                        config('business_templates.views', [])
                    )
                ),
            ],
        ];
    }
}
