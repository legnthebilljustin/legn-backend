<?php

namespace App\Models\Crypto;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App/Models/Crypto/Deposit
 * 
 * @property string $uuid
 * @property int $depositAmount - PHP
 * @property int $fee
 * @property int $exchangePrice - USD
 * @property string $exchangeToken
 * @property int $totalAmount
 * @property Carbon\Carbon $depositDate
 */
class Deposit extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        "depositAmount", "fee", "exchangeToken", "exchangePrice", "totalAmount", "depositDate"
    ];

    protected $hidden = [
        "created_at", "updated_at"
    ];

    protected $casts = [
        "depositDate" => "date"
    ];
}
