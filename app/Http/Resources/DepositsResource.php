<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepositsResource extends JsonResource
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
            "depositAmount" => $this->depositAmount,
            "fee" => $this->fee,
            "exchangeToken" => $this->exchangeToken,
            "exchangePrice" => $this->exchangePrice,
            "totalAmount" => $this->totalAmount,
            "depositDate" => $this->depositDate
        ];
    }
}
