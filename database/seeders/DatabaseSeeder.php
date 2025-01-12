<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CreditCardSeeder::class,
            TransactionCategorySeeder::class,
            CreditTransactionSeeder::class,
            CryptoSeeder::class,
            CryptoWithTradesSeeder::class,
            DepositSeeder::class
        ]);
    }
}
