<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->uuid("uuid")->primary();
            $table->string("cryptoUuid");
            $table->integer("entryPrice");
            $table->float("purchasedAmount");
            $table->float("receivedCryptoAmount");
            $table->float("fee")->default(0);
            $table->float("finalCryptoAmount");
            $table->timestamp("purchaseDate");
            $table->timestamps();

            $table->foreign("cryptoUuid")->references("uuid")->on("cryptos");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trades');
    }
}
