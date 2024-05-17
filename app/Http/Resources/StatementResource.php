<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatementResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "uuid" => $this->uuid,
            "statementDate" => $this->statementDate,
            "amountDue" => $this->amountDue,
            "dueDate" => $this->dueDate
        ];
    }
}