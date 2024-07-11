<?php

namespace App\Models\Crypto;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App/Models/Crypto/Deposit
 * 
 * @property string $uuid
 * @property int $amount
 * @property float $fee
 * @property Carbon\Carbon $depositDate
 */
class Deposit extends Model
{
    use HasFactory, UUID;
}
