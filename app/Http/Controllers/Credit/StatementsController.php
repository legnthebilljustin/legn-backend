<?php

namespace App\Http\Controllers\Credit;

use App\Http\Requests\Credit\StoreStatementRequest;
use App\Http\Resources\TransactionResource;
use App\Repositories\Credit\CreditCardRepository;
use App\Repositories\Credit\CreditTransactionRepository;
use App\Repositories\Credit\StatementRepository;
use App\Resources\StatementResource;
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

    public function getStatementsByCard(string $creditCardUuid) 
    {
        $card = $this->creditCardRepo->getCreditCard($creditCardUuid);
        $statements = $this->statementRepo->getStatementsByCard($card);

        $formattedStatementList = StatementResource::collection($statements);
        
        return response()->json([
            "statements" => $formattedStatementList
        ]);
    }

    public function getStatementTransactionsAndPayments(string $statementUuid)
    {
        $statement = $this->statementRepo->getStatementByUuid($statementUuid);

        $formattedTransactions = TransactionResource::collection($statement->transactions);

        return response()->json([
            "transactions" => $formattedTransactions,
            "payments" => $statement->payments
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

        //check
        $this->statementRepo->checkIfStatementForMonthAndYearExists($card->uuid, $billingDate);
        
        $lastMonthBillingDate = $dateService->generateLastMonthBillingDate();
        $dueDate = $dateService->generateDueDate();

        $transactions = $this->creditTransactionRepo->getTransactionsBetweenTwoBillingDates($card, $billingDate, $lastMonthBillingDate);

        $totalAmount = collect($transactions)->sum("amount");

        $statement = $this->statementRepo->generateStatement($card, $totalAmount, $billingDate, $dueDate);

        return response()->json([
            "statement" => $statement
        ]);
    }
}