<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CreditCardListResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "uuid" => $this->uuid,
            "name"  => $this->name,
            "bank"  => $this->bank,
            "color"  => $this->color
        ];
    }
}