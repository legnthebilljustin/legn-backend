<?php

namespace App\Http\Controllers\Credit;

use App\Http\Requests\Credit\StoreStatementRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Credit\CreditCard;
use App\Repositories\Credit\CreditCardRepository;
use App\Repositories\Credit\CreditTransactionRepository;
use App\Repositories\Credit\StatementRepository;
use App\Services\DateService;

class StatementsController
{
    private $statementRepo;
    private $creditCardRepo;
    private $creditTransactionRepo;

    public function __construct(
        StatementRepository $statementRepository,
        CreditCardRepository $creditCardRepository,
        CreditTransactionRepository $creditTransactionRepository
    )
    {
        $this->statementRepo = $statementRepository;
        $this->creditCardRepo = $creditCardRepository;
        $this->creditTransactionRepo = $creditTransactionRepository;
    }

    public function getStatementsByCard(CreditCard $creditCard) 
    {
        $paginatedStatements = $this->statementRepo->getStatementsByCard($creditCard->uuid);
        
        return response()->json([
            "paginated" => $paginatedStatements
        ]);
    }

    public function getStatementTransactionsAndPayments(string $statementUuid)
    {
        $statement = $this->statementRepo->getStatementByUuid($statementUuid);
        $formattedTransactions = TransactionResource::collection($statement->transactions);

        // TODO: Payments here

        return response()->json([
            "transactions" => $formattedTransactions
        ]);
    }

    // though this should be done automatically by a cron job (laravel task scheduler)
    // but for now we create statements manually by providing a month and year
    public function createStatement(StoreStatementRequest $request)
    {
        $validated = $request->validated();

        $card = $this->creditCardRepo->getCreditCard($validated["creditCardUuid"]);

        $dateService = new DateService($validated["month"], intval($card->billingDate), $validated["year"]);
        $billingDate = $dateService->generateDate();

        $this->statementRepo->checkIfStatementForMonthAndYearExists($card->uuid, $billingDate);
        
        $lastMonthBillingDate = $dateService->generateLastMonthBillingDate();
        $dueDate = $dateService->generateDueDate();

        $transactions = $this->creditTransactionRepo->getTransactionsBetweenTwoBillingDates($card, $billingDate, $lastMonthBillingDate);

        $totalAmount = collect($transactions)->sum("amount");

        $statement = $this->statementRepo->generateStatement($card, $totalAmount, $billingDate, $dueDate, $transactions);

        return response()->json([
            "statement" => $statement
        ]);
    }
}