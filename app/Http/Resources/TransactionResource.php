<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray($request): array
    {
        $card = $this->card;
        $category = $this->transactionCategory;
        return [
            "uuid"              => $this->uuid,
            "merchantName"      => $this->merchantName,
            "creditCard"        => [
                "uuid"      => $card ? $card->uuid : null,
                "bank"      => $card ? $card->bank : null,
            ],
            "category"          => [
                "uuid"      => $category->uuid ?? null,
                "name"      => $category->name ?? null
            ],
            "amount"            => $this->amount,
            "rewardPoints"      => $this->rewardPoints,
            "date"              => $this->date
        ];
    }
}