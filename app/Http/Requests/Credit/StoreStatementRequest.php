<?php

namespace App\Http\Requests\Credit;

use App\Rules\ValidateMonth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStatementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "creditCardUuid" => [
                "required",
                "uuid",
                Rule::exists("credit_cards", "uuid")
            ],
            "month" => ["required", new ValidateMonth],
            "year" => "required|numeric"
        ];
    }
}
