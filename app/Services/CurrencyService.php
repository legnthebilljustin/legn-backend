<?php

namespace App\Services;

class CurrencyService 
{
    // convert monetary values into cents. typically used before inserting to db
    public function convertToCents($request, array $properties = []): array
    {
        $data = $request->all();

        foreach($properties as $property) {
            if (isset($data[$property])) {
                $value = $data[$property];
                // Round to two decimal places before converting to cents
                $value = round($value, 2);
                $data[$property] = round($value * 100);
            }
        }

        return $data;
    }
}