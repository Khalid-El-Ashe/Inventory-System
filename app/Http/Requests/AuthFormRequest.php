<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class AuthFormRequest extends FormRequest
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
        $blackLists = ['laravel', 'admin', 'manager', 'user', 'language', 'customer', 'hacker'];

        return [
            'name' => 'nullable|string|max:255',
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
            'remember' => 'nullable|boolean',
            'guard' => 'required|string|in:admin,manager,customer',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters long.',
            'remember.boolean' => 'Remember me must be true or false.',
            'guard.in' => 'Please check the login link (guard).',
        ];
    }

    // public function validated($key = null, $default = null)
    // {
    //     $data = parent::validated($key, $default);

    //     if (isset($data['password'])) {
    //         $data['password'] = Hash::make($data['password']);
    //     }

    //     return $data;
    // }
}
