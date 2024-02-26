<?php

namespace App\Models\Credit;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Credit\CreditCard;

/**
 * App/Models/Credit/Payment
 * 
 * @property string $creditCardUuid
 * @property string $amount
 * @property date $date
 */
class Payment extends Model
{
    use HasFactory;
    use UUID;

    protected $guarded = [];

    protected $fillable = [
        "creditCardUuid", "amount", "date"
    ];

    public function creditCard()
    {
        return $this->belongsTo(CreditCard::class, "creditCardUuid");
    }
}
