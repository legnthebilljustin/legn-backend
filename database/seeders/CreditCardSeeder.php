<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Credit\CreditCard;

class CreditCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            [
                "name" => "Rewards Plus Visa",
                "bank" => "Metrobank",
                "creditLimit" => 50000,
                "amountPerPoint" => 35,
                "color" => "blue",
                "billingDate" => "21"
            ],
            [
                "name" => "Gold",
                "bank" => "Security Bank",
                "creditLimit" => 100000,
                "amountPerPoint" => 35,
                "color" => "yellow",
                "billingDate" => "12"
            ],
        ];

        foreach ($banks as $bank) {
            CreditCard::create($bank);
        }
    }
}
