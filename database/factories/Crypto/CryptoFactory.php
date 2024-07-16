<?php

namespace Database\Factories\Crypto;

use Illuminate\Database\Eloquent\Factories\Factory;

class CryptoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->word,
            "code" => strtoupper($this->faker->lexify('???'))
        ];
    }
}
