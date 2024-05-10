<?php

namespace App\Repositories\Credit;

use App\Enums\CardKeysEnum;
use App\Models\Credit\CreditCard;

class CreditCardRepository
{
    public function getCreditCard(string $uuid): CreditCard
    {
        return CreditCard::where("uuid", $uuid)->firstOrFail();
    }

    public function incrementCardTotals(
        CreditCard $card,
        float $amount,
        int $rewardPoints
    )
    {
        $card->increment(CardKeysEnum::TOTAL_AMOUNT_SPENT, $amount);
        $card->increment(CardKeysEnum::TOTAL_REWARD_POINTS, $rewardPoints);
    }

    public function decrementCardTotals(
        CreditCard $card,
        float $amount,
        int $rewardPoints
    )
    {
        $card->decrement(CardKeysEnum::TOTAL_AMOUNT_SPENT, $amount);
        $card->decrement(CardKeysEnum::TOTAL_REWARD_POINTS, $rewardPoints);
    }

    public function incrementAggregate(CreditCard $card, string $propertyName, float $amount) 
    {
        $card->increment($propertyName, $amount);
    }
}