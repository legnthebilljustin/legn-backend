<?php

namespace App\Http\Requests\Crypto;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepositsRequest extends FormRequest
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
            "depositAmount" => "required|numeric",
            "fee" => "required|numeric",
            "exchangeToken" => "required|string",
            "exchangePrice" => "required|numeric",
            "totalAmount" => "required|numeric",
            "depositDate" => "required|date"
        ];
    }
}
