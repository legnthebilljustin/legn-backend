<?php

namespace App\Http\Controllers\Credit;

use App\Http\Controllers\Controller;
use App\Http\Requests\Credit\StoreTransactionRequest;
use App\Http\Requests\Credit\UpdateTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Credit\CreditCard;
use App\Repositories\Credit\CreditCardRepository;
use App\Repositories\Credit\CreditTransactionRepository;
use App\Repositories\Credit\TransactionCategoryRepository;

class TransactionsController extends Controller
{
    protected $creditCardRepo;
    protected $creditTransactionRepo;
    protected $transactionCategoryRepo;

    public function __construct(
        CreditCardRepository $creditCardRepository,
        CreditTransactionRepository $creditTransactionRepository,
        TransactionCategoryRepository $transactionCategoryRepository
    ) {
        $this->creditCardRepo = $creditCardRepository;
        $this->creditTransactionRepo = $creditTransactionRepository;
        $this->transactionCategoryRepo = $transactionCategoryRepository;
    }

    public function allTransactionsByCard(CreditCard $creditCard)
    {
        $transactions = $creditCard->transactions;
        $formatted = TransactionResource::collection($transactions);
        return response()->json([
            "transactions" => $formatted
        ]);
    }

    public function afterBillingDate(CreditCard $creditCard)
    {
        $transactions = $this->creditTransactionRepo->getTransactionsAfterLastBilling($creditCard);
        $resource = TransactionResource::collection($transactions);
        $totalAmount = $resource->sum("amount");
        $totalRewardPoints = $resource->sum("rewardPoints");

        return response()->json([
            "transactions" => $resource,
            "totalAmount" => $totalAmount,
            "totalRewardPoints" => $totalRewardPoints
        ]);
    }

    public function store(StoreTransactionRequest $request)
    {
        $validated = $request->validated();

        $card = $this->creditCardRepo->getCreditCard($validated["creditCardUuid"]);
        $category = $this->transactionCategoryRepo->getCategory($validated["transactionCategoryUuid"]);

        $newTransaction = $this->creditTransactionRepo->createTransaction($card, $category, $validated);

        $transactionResource = new TransactionResource($newTransaction);

        return response()->json([
            "message" => "New credit card transaction has been added.",
            "transaction" => $transactionResource
        ], 200);
    }

    public function show($uuid)
    {
        $transaction = $this->creditTransactionRepo->getTransactionByUuid($uuid);
    
        $transactionResource = new TransactionResource($transaction);
        return response()->json([
            "transaction" => $transactionResource
        ], 200);
    }

    public function update(UpdateTransactionRequest $request, $uuid)
    {
        $transaction = $this->creditTransactionRepo->getTransactionByUuid($uuid);
        
        $validated = $request->validated();

        $card = $this->creditCardRepo->getCreditCard($transaction->creditCardUuid);
        $category = $this->transactionCategoryRepo->getCategory($transaction->transactionCategoryUuid);

        $updatedTransaction = $this->creditTransactionRepo->updateTransaction(
            $card,
            $transaction,
            $category,
            $validated
        );

        $transactionResource = new TransactionResource($updatedTransaction);

        return response()->json([
            "message" => "Transaction updated.",
            "transaction" => $transactionResource
        ], 200);
    }

    public function destroy($id)
    {
        //
    }
}
