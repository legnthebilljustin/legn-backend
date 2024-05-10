<?php

namespace App\Repositories\Credit;

use App\Models\Credit\TransactionCategory;
use Illuminate\Support\Collection;

class TransactionCategoryRepository
{
    public function getCategory(string $uuid): TransactionCategory
    {
        return TransactionCategory::where("uuid", $uuid)->firstOrFail();
    }

    public function getCategoryByName(string $name): TransactionCategory
    {
        return TransactionCategory::where("name", $name)->firstOrFail();
    }

    public function getAllCategories(): Collection
    {
        return TransactionCategory::all();
    }

    // this is a note to refactor this into a separate table and model - aggregates for more flexibility
    public function isAnAggregateCategory(string $uuid): bool
    {
        // get all categories
        return false;
    }

    public function updateCategory(string $uuid, $formData): TransactionCategory
    {
        $category = TransactionCategory::where("uuid", $uuid)->firstOrFail();
        $category->name = $formData["name"];
        $category->eligibleForPoints = $formData["eligibleForPoints"];
        $category->save();

        return $category;
    }
}