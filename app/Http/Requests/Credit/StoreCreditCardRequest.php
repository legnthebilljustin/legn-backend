<?php

namespace App\Http\Requests\Credit;

use Illuminate\Foundation\Http\FormRequest;

class StoreCreditCardRequest extends FormRequest
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
            // might be a good idea to add a unique here?
            "name" => "required|string",
            "bank" => "required|string",
            "creditLimit" => "required|numeric",
            "amountPerPoint" => "required|int",
            "color" => "required|string",
            "billingDate" => "required|string"
        ];
    }
}
