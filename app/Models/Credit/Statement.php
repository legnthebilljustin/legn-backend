<?php

namespace App\Models\Credit;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Credit\CreditCard
 * 
 * @property $uuid
 * @property $statementDate
 * @property $amountDue
 * @property $dueDate
 * @property $creditCardUuid
 */
class Statement extends Model
{
    use HasFactory;
    use UUID;

    protected $guarded = [];
    protected $dates = ["dueDate", "statementDate"];
    protected $fillable = [
        "creditCardUuid", "statementDate", "amountDue", "dueDate"
    ]; 
    
    public function transactions()
    {
        return $this->hasMany(CreditTransaction::class, "statementUuid");
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, "statementUuid");
    }

    public function creditCard()
    {
        return $this->belongsTo(CreditCard::class, "creditCardUuid");
    }
}
