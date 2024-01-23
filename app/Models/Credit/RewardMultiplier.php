<?php

namespace App\Models\Credit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Credit\CreditCard;
use App\Models\Credit\TransactionCategory;
use App\Traits\UUID;

/**
 * App\Models\Credit\RewardMultiplier
 * 
 * @property string $uuid
 * @property string $creditCardUuid
 * @property string $transactionCategoryUuid
 * @property int $multiplier
 */
class RewardMultiplier extends Model
{
    use HasFactory;
    use UUID;

    public $timestamps = false;

    protected $fillable = [
        "creditCardUuid", 
        "transactionCategoryUuid",
        "multiplier"
    ];

    public function creditCard()
    {
        return $this->belongsTo(CreditCard::class, "creditCardUuid");
    }

    public function transactionCategory()
    {
        return $this->belongsTo(TransactionCategory::class, "transactionCategoryUuid");
    }
}
