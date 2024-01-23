<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreditTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("credit_transactions", function(Blueprint $table) {
            $table->uuid("uuid")->primary();
            $table->string("merchantName")->nullable(false);
            $table->string("creditCardUuid")->nullable(false);
            $table->string("transactionCategoryUuid")->nullable(false);
            $table->float("amount")->default(0);
            $table->integer("rewardPoints")->default(0);
            $table->timestamp("date")->nullable(false);

            $table->foreign("creditCardUuid")->references("uuid")->on("credit_cards");
            $table->foreign("transactionCategoryUuid")->references("uuid")->on("transaction_categories");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("credit_transactions");
    }
}
