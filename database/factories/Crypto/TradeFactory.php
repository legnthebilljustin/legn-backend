<?php

namespace Database\Factories\Crypto;

use App\Models\Crypto\Crypto;
use Illuminate\Database\Eloquent\Factories\Factory;

class TradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cryptoUuid' => Crypto::factory(),
            'entryPrice' => $this->faker->randomFloat(2, 1000, 50000),
            'amountUSD' => $this->faker->randomFloat(2, 100, 10000),
            'fee' => $this->faker->randomFloat(2, 0, 100),
            'receivedCryptoAmount' => $this->faker->randomFloat(8, 0.001, 10),
            'finalCryptoAmount' => $this->faker->randomFloat(8, 0.001, 10),
            'tradeDate' => $this->faker->date,
        ];
    }
}
