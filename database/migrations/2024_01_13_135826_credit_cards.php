<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreditCards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("credit_cards", function(Blueprint $table) {
            $table->uuid("uuid")->primary();
            $table->string("name")->nullable(false);
            $table->string("bank")->nullable(false);
            $table->integer("creditLimit")->nullable(false);
            $table->integer("amountPerPoint")->nullable(false);
            $table->string("color")->nullable(false);
            $table->integer("totalCashbacks")->default(0);
            $table->float("totalFinanceCharges")->default(0);
            $table->integer("totalRewardPoints")->default(0);
            $table->float("totalAmountSpent")->default(0);
            $table->integer("totalTransactions")->default(0);
            $table->integer("totalTreats")->default(0);
            $table->string("billingDate")->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("credit_cards");
    }
}
