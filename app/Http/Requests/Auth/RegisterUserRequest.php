<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => "required|string",
            "email" => "required|email|unique:users",
            "password" => "required",
            "confirmPassword" => "required|same:password"
        ];
    }
}