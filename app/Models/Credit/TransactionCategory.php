<?php

namespace App\Models\Credit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Credit\CreditTransaction;
use App\Models\Credit\RewardMultiplier;
use App\Traits\UUID;

/**
 * App\Models\Credit\TransactionCategory
 * 
 * @property string $uuid
 * @property string $name
 * @property bool $eligibleForPoints
 */
class TransactionCategory extends Model
{
    use HasFactory;
    use UUID;

    protected $casts = [
        "eligibleForPoints" => "boolean"
    ];
    
    protected $fillable = [
        "name",
        "eligibleForPoints"
    ];

    public function transaction()
    {
        return $this->hasMany(CreditTransaction::class, "transactionCategoryUuid");
    }

    public function rewardMultipliers()
    {
        return $this->hasMany(RewardMultiplier::class, "transactionCategoryUuid");
    }
}
