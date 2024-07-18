<?php

namespace Database\Factories\Crypto;

use Illuminate\Database\Eloquent\Factories\Factory;

class DepositFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $depositAmount = $this->faker->randomFloat(2, 10000, 9999999);
        $fee = 2500;
        return [
            "depositAmount" => $depositAmount,
            "fee" => $fee,
            "exchangePrice" => 5520,
            "exchangeToken" => "USDT",
            "totalAmount" => $depositAmount - $fee,
            "depositDate" => $this->faker->date
        ];
    }
}
