<?php

namespace App\Models\Crypto;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App/Models/Crypto/Crypto
 * 
 * @property string $uuid
 * @property string $name
 * @property string $code
 * @property-read string Collection<Trade> $trades
 */
class Crypto extends Model
{
    use HasFactory, UUID;

    public function trades() {
        return $this->hasMany(Trade::class, "cryptoUuid");
    }
}
