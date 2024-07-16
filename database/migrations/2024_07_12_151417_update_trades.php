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
        /**
         * when using `change` and `renameColumn` combo,
         * laravel is resetting the column type to its original type if they are both done in a single migration
         */
        Schema::table('trades', function (Blueprint $table) {
            $table->integer('purchasedAmount')->change();
        });

        Schema::table('trades', function (Blueprint $table) {
            $table->renameColumn('purchasedAmount', 'amountUSD');
            $table->renameColumn('purchaseDate', 'tradeDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('trades', function (Blueprint $table) {
            $table->renameColumn('amountUSD', 'purchasedAmount');
            $table->renameColumn('tradeDate', 'purchaseDate');
        });

        Schema::table('trades', function (Blueprint $table) {
            $table->float('purchasedAmount')->change();
        });
    }
}
