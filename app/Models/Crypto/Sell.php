<?php

namespace App\Models\Crypto;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory, UUID;

    public function trade() {
        return $this->belongsTo(Trade::class, "tradeUuid");
    }
}
