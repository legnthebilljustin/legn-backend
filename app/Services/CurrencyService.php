<?php

namespace App\Services;

class CurrencyService 
{
    /**
     * convert monetary values into cents. typically used before inserting to db
     * @param array $validatedData - the validated form request
     * @param array $properties - the `validatedData` properties that we want to convert into cents`
     */
    public function convertToCents(array $validatedData, array $properties = []): array
    {
        foreach($properties as $property) {
            if (isset($validatedData[$property])) {
                $value = $validatedData[$property];
                // Round to two decimal places before converting to cents
                $value = round($value, 2);
                $validatedData[$property] = round($value * 100);
            }
        }

        return $validatedData;
    }
}