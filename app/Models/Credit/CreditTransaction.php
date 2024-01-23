<?php

namespace App\Models\Credit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Credit\CreditCard;
use App\Models\Credit\TransactionCategory;
use App\Traits\UUID;

/**
 * App\Models\Credit\Transaction
 * 
 * @property string $uuid
 * @property string $merchantName
 * @property string $creditCardUuid
 * @property string $transactionCategoryUuid
 * @property float $amount
 * @property int $rewardPoints
 * @property \Illuminate\Support\Carbon|null $date
 */
class CreditTransaction extends Model
{
    use HasFactory;
    use UUID;

    public $timestamps = false;

    protected $primaryKey = "uuid";
    protected $guarded = [];
    
    protected $dates = ["updated_at", "created_at"];
    protected $fillable = [
        "merchantName", "creditCardUuid", "rewardPoints",
        "transactionCategoryUuid", "amount",
        "date"
    ];

    public function card()
    {
        return $this->belongsTo(CreditCard::class, "creditCardUuid");
    }

    public function transactionCategory()
    {
        return $this->belongsTo(TransactionCategory::class, "transactionCategoryUuid");
    }
}
