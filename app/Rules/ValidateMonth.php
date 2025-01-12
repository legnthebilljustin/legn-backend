<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateMonth implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // returning vague error if given with 04...
        return is_int($value) && $value >= 1 && $value <= 12;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '$month must be a numeric value from 1 to 12.';
    }
}
