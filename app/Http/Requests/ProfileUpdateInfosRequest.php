<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateInfosRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'email' => ['required'],
            'bio' => ['nullable', 'string'],
            'password' => ['required', 'min:8', 'max:255', 'regex:/[\W_]+/'],
            'new_password' => ['nullable', 'min:8', 'max:255', 'regex:/[\W_]+/', 'confirmed'],
            'new_password_confirmation' => ['nullable', 'min:8', 'max:255', 'regex:/[\W_]+/'],
        ];
    }
}