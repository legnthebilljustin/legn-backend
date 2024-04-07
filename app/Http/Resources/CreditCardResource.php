<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CreditCardResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "uuid" => $this->uuid,
            "name"  => $this->name,
            "bank"  => $this->bank,
            "creditLimit"   => $this->creditLimit,
            "amountPerPoint"    => $this->amountPerPoint,
            "color"  => $this->color,
            "totals" => [
                "cashbacks"             => $this->totalCashbacks,
                "financeCharges"        => $this->totalFinanceCharges,
                "rewardPoints"          => $this->totalRewardPoints,
                "treats"                => $this->totalTreats,
                "transactions"          => $this->totalTransactions,
                "amountSpent"           => $this->totalAmountSpent,
            ]
        ];
    }
}