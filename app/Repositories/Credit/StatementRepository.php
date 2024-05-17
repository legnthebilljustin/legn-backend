<?php

namespace App\Repositories\Credit;

use App\Models\Credit\CreditCard;
use App\Models\Credit\Statement;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\Paginator;

class StatementRepository
{
    public function getStatementByUuid(string $uuid): Statement
    {
        $statement = Statement::where("uuid", $uuid)->firstOrFail();

        return $statement;
    }
    
    public function getStatementsByCard(string $creditCardUuid): Paginator
    {
        $statements = Statement::where("creditCardUuid", $creditCardUuid)
            ->orderByDesc("statementDate")
            ->simplePaginate(15);

        return $statements;
    }

    public function checkIfStatementForMonthAndYearExists(string $creditCardUuid, Carbon $statementDate)
    {
        $formatted = $statementDate->format("Y-m-d");
        $statement = Statement::where("creditCardUuid", $creditCardUuid)
                        ->where("statementDate", $formatted)
                        ->first();

        if (!empty($statement)) {
            abort(400, "Statement already generated for the given month and year.");
        }
        return $statement;
    }

    public function generateStatement(
        CreditCard $card, int $amountDue,
        Carbon $statementDate, Carbon $dueDate
    )
    {
        $formattedDueDate = $dueDate->format("Y-m-d");
        $formattedStatementDate = $statementDate->format("Y-m-d");
        
        return Statement::create([
            "creditCardUuid" => $card->uuid,
            "statementDate" => $formattedStatementDate,
            "dueDate" => $formattedDueDate,
            "amountDue" => $amountDue
        ]);
    }
}