<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransactionCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("transaction_categories", function(Blueprint $table) {
            $table->uuid("uuid")->primary();
            $table->string("name")->nullable(false);
            $table->boolean("eligibleForPoints")->default(0);
            $table->timestamps();

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
        Schema::dropIfExists("transaction_categories");
    }
}
