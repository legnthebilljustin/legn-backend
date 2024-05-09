<?php

namespace App\Services\Credit;

use App\Models\Credit\CreditCard;
use App\Models\Credit\TransactionCategory;

class RewardPointsService
{
    public function calculateRewardPoints(
        TransactionCategory $category,
        CreditCard $card,
        float $amount
    ): int
    {
        if ($category["eligibleForPoints"]) {
            $multiplierData = $category->rewardMultipliers()->where("creditCardUuid", $card->uuid)->first();
            
            $multiplier = $multiplierData ? $multiplierData->multiplier : 1;
            $initialReward = intval($amount) / $card["amountPerPoint"];

            return $initialReward * $multiplier;
        }
        
        return 0;
    }
}