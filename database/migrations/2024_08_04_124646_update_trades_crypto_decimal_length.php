<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTradesCryptoDecimalLength extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("trades", function(Blueprint $table) {
            $table->float("receivedCryptoAmount", 9, 8)->change();
            $table->float("fee", 9, 8)->change();
            $table->float("finalCryptoAmount", 9, 8)->change();
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
            $table->float("fee", 8, 2)->change();
            $table->float("finalCryptoAmount", 8, 2)->change();
            $table->float("receivedCryptoAmount", 8, 2)->change();
        });
    }
}
