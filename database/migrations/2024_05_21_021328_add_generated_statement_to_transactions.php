<?php

use App\Models\Credit\CreditTransaction;
use App\Models\Credit\Statement;
use App\Services\DateService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class AddGeneratedStatementToTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $statements = Statement::get();
   
            $statements->each(function($statement) {
                // get the statementDate
                $statementDate = $statement->statementDate ?? null;
                $creditCardUuid = $statement->creditCardUuid ?? null;

                if (is_null($statementDate) || is_null($creditCardUuid)) {
                    return;
                }

                $date = Carbon::create($statementDate);

                // get last month's statement date
                $lastMonthStatementDate = $date->copy()->subMonth();

                // get transactions within those dates
                $transactions = CreditTransaction::where("creditCardUuid", $creditCardUuid)
                        ->whereDate("date", "<=", $statementDate)
                        ->whereDate("date", ">", $lastMonthStatementDate)
                        ->get();
                
                $transactions->each(function($transaction) use($statement) {

                    $keyExists = array_key_exists("statementUuid", $transaction->toArray());
                    
                    if ($keyExists && $transaction->statementUuid === NULL) {
                        $transaction->statementUuid = $statement->uuid;
                        $transaction->save();
                    }
                });
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            //
        });
    }
}
