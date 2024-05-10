<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statements', function (Blueprint $table) {
            $table->uuid("uuid")->primary();
            $table->date("statementDate");
            $table->float("amountDue");
            $table->date("dueDate");
            $table->uuid("creditCardUuid");
            $table->timestamps();

            $table->foreign("creditCardUuid")->references("uuid")->on("credit_cards");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statements');
    }
}
