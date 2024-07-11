<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sells', function (Blueprint $table) {
            $table->uuid("uuid")->primary();
            $table->string("tradeUuid");
            $table->integer("sellingPrice");
            $table->float("amount");
            $table->float("fee");
            $table->integer("totalSellAmount");
            $table->timestamp("sellDate");
            $table->timestamps();

            $table->foreign("tradeUuid")->references("uuid")->on("trades");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sells');
    }
}
