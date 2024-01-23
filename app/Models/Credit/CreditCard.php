<?php

namespace App\Models\Credit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Credit\CreditTransaction;
use App\Models\Credit\RewardMultiplier;
use App\Traits\UUID;

/**
 * App\Models\Credit\CreditCard
 * 
 * @property string $uuid
 * @property string $name
 * @property string bank
 * @property int $creditLimit
 * @property int $amountPerPoint
 * @property string $color
 * @property int $totalCashbacks
 * @property int $totalFinanceCharges
 * @property int $totalRewardPoints
 * @property int $totalAmountSpent
 * @property int $totalTransactions
 * @property int $totalTreats
 * @property string $billing_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class CreditCard extends Model
{
    use HasFactory;
    use UUID;

    protected $guarded = [];

    protected $fillable = [
        "name", "bank", "creditLimit", "color", "amountPerPoint", "billingDate"
    ];

    public function transactions()
    {
        return $this->hasMany(CreditTransaction::class, "creditCardUuid");
    }

    public function rewardMultipliers()
    {
        return $this->hasMany(RewardMultiplier::class, "creditCardUuid");
    }
}
