<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserDetailsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "uuid" => $this->uuid,
            "name" => $this->name,
            "email" => $this->email
        ];
    }
}