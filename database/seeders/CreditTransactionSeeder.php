<?php

namespace Database\Seeders;

use App\Models\Credit\CreditCard;
use App\Models\Credit\CreditTransaction;
use App\Models\Credit\TransactionCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreditTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $creditCards = CreditCard::all();
        $categories = TransactionCategory::all();

        $transactions = [
            [
                "merchantName" => "Sample Merchant 1",
                "transactionCategoryUuid" => $categories[0]->uuid,
                "amount" => 5000,
                "rewardPoints" => 175,
                "date" => now()->subDays(5), // Example: 5 days ago
            ],
            [
                "merchantName" => "Sample Merchant 2",
                "transactionCategoryUuid" => $categories[0]->uuid,
                "amount" => 8000,
                "rewardPoints" => 280,
                "date" => now()->subDays(10), // Example: 10 days ago
            ],
        ];

        foreach($transactions as $transaction) {
            $transaction["creditCardUuid"] = $creditCards[0]["uuid"];

            CreditTransaction::create($transaction);
        }
    }
}
