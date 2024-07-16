<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TradesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "uuid" => $this->uuid,
            "entryPrice" => $this->entryPrice,
            "amountUSD" => $this->amountUSD,
            "fee" => $this->fee,
            "finalCryptoAmount" => $this->finalCryptoAmount,
            "tradeDate" => $this->tradeDate,
            "crypto" => $this->crypto
        ];
    }
}
