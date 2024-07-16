<?php

namespace Database\Seeders;

use App\Models\Crypto\Crypto;
use Illuminate\Database\Seeder;

class CryptoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cryptos = [
            [
                "name" => "Bitcoin",
                "code" => "BTC"
            ],
            [
                "name" => "Ethereum",
                "code" => "ETH"
            ],
            [
                "name" => "Cardano",
                "code" => "ADA"
            ],
        ];

        foreach($cryptos as $crypto) {
            Crypto::create($crypto);
        }
    }
}
