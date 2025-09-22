<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => [
                'required',
                'email',
                'max:255',
            ],

            'required|string|min:6',
            'nullable|string|min:6',
            'role'     => 'required|in:admin,member',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'User name is required.',
            'email.required'    => 'Email is required.',
            'email.email'       => 'Please provide a valid email address.',
            'email.unique'      => 'This email is already registered.',
            'password.required' => 'Password is required when creating a user.',
            'password.min'      => 'Password must be at least 6 characters.',
            'role.required'     => 'Role is required.',
            'role.in'           => 'Role must be either admin or member.',
        ];
    }
}
