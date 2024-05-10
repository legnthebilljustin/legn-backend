<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCreditTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("credit_transactions", function(Blueprint $table) {
            $table->uuid("statementUuid")->after("date")->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("credit_transactions", function(Blueprint $table) {
            $table->dropColumn("statementUuid");
        });
    }
}
