<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardMultiplersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reward_multipliers', function (Blueprint $table) {
            $table->uuid("uuid")->primary();
            $table->uuid("creditCardUuid")->nullable(false);
            $table->uuid("transactionCategoryUuid")->nullable(false);
            $table->integer("multiplier")->default(1);
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
        Schema::dropIfExists('reward_multiplers');
    }
}
