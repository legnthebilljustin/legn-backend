<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Credit\TransactionCategory;
use App\Enums\TransactionCategories;

class TransactionCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            TransactionCategories::TRAVEL,
            TransactionCategories::ELECTRONICS,
            TransactionCategories::DINING,
            TransactionCategories::GROCERY,
            TransactionCategories::UTILITIES,
            TransactionCategories::GAS,
            TransactionCategories::PAYMENT,
            TransactionCategories::FINANCE_CHARGE,
            TransactionCategories::CASH_ADVANCE,
        ];

        foreach ($categories as $category) {
            TransactionCategory::create($category);
        }
    }
}