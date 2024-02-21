<?php

namespace App\Repositories;

use App\Models\Credit\CreditCard;
use App\Models\Credit\CreditTransaction;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class CreditTransactionRepository
{
    public function getTransactionsAfterLastBilling(CreditCard $creditCard): Collection
    {
        $startingDate = $this->determineStartingDate($creditCard);

        return CreditTransaction::where("creditCardUuid", $creditCard->uuid)
                ->where("date", ">", $startingDate)
                ->orderBy("date", "desc")
                ->get();
    }

    private function determineStartingDate(CreditCard $creditCard)
    {
        $now = Carbon::now();
        $billingDate = Carbon::now()->day($creditCard->billingDate);

        $startingDate = $now->greaterThan($billingDate) ? $billingDate : $billingDate->subMonth();

        return $startingDate;
    }
}