<?php

namespace App\Repositories\Credit;

use App\Models\Credit\CreditCard;
use App\Models\Credit\CreditTransaction;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Services\TransactionCategoryService;
use App\Enums\TransactionCategories;
use App\Http\Requests\Credit\StoreTransactionRequest;
use App\Models\Credit\TransactionCategory;
use App\Services\Credit\RewardPointsService;
use Illuminate\Support\Facades\DB;

class CreditTransactionRepository
{
    private $creditCardRepo;
    private $rpService;

    public function __construct(CreditCardRepository $creditCardRepository, RewardPointsService $rewardPointsService) {
        $this->creditCardRepo = $creditCardRepository;
        $this->rpService = $rewardPointsService;
    }

    public function getTransactionByUuid(string $uuid): CreditTransaction
    {
        return CreditTransaction::where("uuid", $uuid)->firstOrFail();
    }

    public function getTransactionsAfterLastBilling(CreditCard $creditCard): Collection
    {
        $startingDate = $this->determineStartingDate($creditCard);

        return CreditTransaction::where("creditCardUuid", $creditCard->uuid)
                ->where("date", ">", $startingDate)
                ->orderBy("date", "desc")
                ->get();
    }

    public function getCurrentBalance(CreditCard $creditCard)
    {
        $transactions = $this->getTransactionsAfterLastBilling($creditCard);
    
        $categoryUuidToExclude = TransactionCategoryService::getCategoryUuid(TransactionCategories::PAYMENT["name"]);

        $totalAmount = $transactions
                ->where('transaction_type', '!=', $categoryUuidToExclude)
                ->sum('amount');
                
        return $totalAmount;
    }

    public function createTransaction(
        CreditCard $card, 
        TransactionCategory $category,
        $formData
    ): CreditTransaction
    {
        $formData["rewardPoints"] = $this->rpService->calculateRewardPoints($category, $card, $formData["amount"]);
        return DB::transaction(function() use($card, $formData) {
            $card->increment("totalTransactions");
            $this->creditCardRepo->incrementCardTotals($card, $formData["amount"], $formData["rewardPoints"]);

            return CreditTransaction::create($formData);
        });
    }

    public function updateTransaction(
        CreditCard $card,
        CreditTransaction $transaction,
        TransactionCategory $category,
        $formData
    ): CreditTransaction
    {
        $transaction->date = $formData["date"];
        $transaction->merchantName = $formData["merchantName"];

        if ($transaction->amount !== $formData["amount"]) {
            $newRewardPoints = $this->rpService->calculateRewardPoints($category, $card, $formData["amount"]);

            DB::transaction(function() use($card, $transaction, $formData, $newRewardPoints) {
                $this->creditCardRepo->decrementCardTotals($card, $transaction->amount, $transaction->rewardPoints);
                $this->creditCardRepo->incrementCardTotals($card, $formData["amount"], $newRewardPoints);

                $transaction->amount = $formData["amount"];
                $transaction->rewardPoints = $newRewardPoints;
            });
        }

        $transaction->save();

        return $transaction;
    }

    private function determineStartingDate(CreditCard $creditCard)
    {
        $now = Carbon::now();
        $billingDate = Carbon::now()->day($creditCard->billingDate);

        $startingDate = $now->greaterThan($billingDate) ? $billingDate : $billingDate->subMonth();

        return $startingDate;
    }
}