<?php

namespace App\Http\Requests\Credit;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRewardMultiplierRequest extends FormRequest
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
            "transactionCategoryUuid" => [
                "required",
                "uuid",
                Rule::exists("transaction_categories", "uuid")
            ],
            "multiplier" => "required|integer"
        ];
    }
}
