<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTrades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("trades", function(Blueprint $table) {
            $table->integer("purchasedAmount")->change();

            $table->renameColumn("purchasedAmount", "amountUSD");
            $table->renameColumn("purchaseDate", "tradeDate");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("trades", function(Blueprint $table) {
            $table->float("amountUSD")->change();

            $table->renameColumn("amountUSD", "purchasedAmount");
            $table->renameColumn("tradeDate", "purchaseDate");
        });
    }
}
