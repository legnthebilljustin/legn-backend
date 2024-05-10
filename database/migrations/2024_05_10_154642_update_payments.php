<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("payments", function(Blueprint $table) {
            $table->float("amount");
            $table->uuid("creditCardUuid");
            $table->uuid("statementUuid");
            $table->date("date");

            $table->foreign("creditCardUuid")->references("uuid")->on("credit_cards");
            $table->foreign("statementUuid")->references("uuid")->on("statements");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['creditCardUuid']);
            $table->dropForeign(['statementUuid']);
            $table->dropColumn(['amount', 'creditCardUuid', 'statementUuid', 'date']);
        });
    }
}
