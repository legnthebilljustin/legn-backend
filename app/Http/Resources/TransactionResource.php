<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray($request): array
    {
        $category = $this->transactionCategory;
        return [
            "uuid"              => $this->uuid,
            "merchantName"      => $this->merchantName,
            "category"          => $category->name ?? "",
            "amount"            => $this->amount,
            "rewardPoints"      => $this->rewardPoints,
            "date"              => $this->date,
        ];
    }
}