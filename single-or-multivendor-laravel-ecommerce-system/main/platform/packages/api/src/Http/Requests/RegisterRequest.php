<?php

namespace Botble\Api\Http\Requests;

use Botble\Api\Facades\ApiHelper;
use Botble\Support\Http\Requests\Request;

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password; // Ensure this is imported

class RegisterRequest extends FormRequest
{
    public function messages()
    {
        return [
            'password.regex' => 'The password must be at least 8 characters long and include at least one letter, one number, and one special character.',
        ];
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:120|min:2',
            'last_name' => 'required|string|max:120|min:2',
            'email' => 'required|max:60|min:6|email|unique:' . ApiHelper::getTable(),
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],
        ];
    }
}
