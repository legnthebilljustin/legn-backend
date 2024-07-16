<?php

namespace Database\Seeders;

use App\Models\Crypto\Crypto;
use Illuminate\Database\Seeder;

class CryptoWithTradesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Crypto::factory()
            ->hasTrades(5)
            ->create();
    }
}
