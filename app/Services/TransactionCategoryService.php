<?php

namespace App\Services;

use App\Models\Credit\TransactionCategory;

class TransactionCategoryService 
{
    public static function getCategoryUuid(string $name)
    {
        $category = TransactionCategory::where("name", $name)->first();

        if ($category) {
            return $category->uuid;
        }

        return null;
    }
}