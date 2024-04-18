<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->symbols()->numbers()],
            'password_confirmation' => ['required', 'min:8'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ad Soyad sahəsinin daxil olunması vacibdir!',
            'name.string' => 'Ad Soyad sahəsinə rəqəm və ya digər simvollar daxil ola bilməz!',
        ];
    }
}
