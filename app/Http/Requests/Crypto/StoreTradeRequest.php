<?php

namespace App\Http\Requests\Crypto;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTradeRequest extends FormRequest
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
            "cryptoUuid" => [
                "required", "uuid",
                Rule::exists("cryptos", "uuid")
            ],
            "entryPrice" => "required|numeric",
            "amountUSD" => "required|numeric",
            "fee" => "required|numeric",
            "receivedCryptoAmount" => "required|numeric",
            "finalCryptoAmount" => "required|numeric",
            "tradeDate" => "required|date",
        ];
    }
}
