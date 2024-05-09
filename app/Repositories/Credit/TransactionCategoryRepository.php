<?php

namespace App\Repositories\Credit;

use App\Models\Credit\TransactionCategory;

class TransactionCategoryRepository
{
    public function getCategory(string $uuid): TransactionCategory
    {
        return TransactionCategory::where("uuid", $uuid)->firstOrFail();
    }
}