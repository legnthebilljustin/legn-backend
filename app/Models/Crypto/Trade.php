<?php

namespace App\Models\Crypto;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App/Models/Crypto/Trade
 * 
 * @property string $uuid
 * @property int $entryPrice - USD
 * @property int $amountUSD - USD
 * @property float $receivedCryptoAmount
 * @property float $fee
 * @property float $finalCryptoAmount
 * @property \Illuminate\Support\Carbon|null $tradeDate
 */
class Trade extends Model
{
    use HasFactory, UUID;

    public function crypto() {
        return $this->belongsTo(Crypto::class, "cryptoUuid");
    }

    public function sells() {
        return $this->hasMany(Sell::class, "tradeUuid");
    }
}