<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePaymentPrimaryKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->uuid('uuid')->primary()->unique();
            $table->dropColumn('id');
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
            // Drop the primary key constraint if it exists
            $table->dropPrimary(["uuid"]);
            // Drop the column named uuid
            $table->dropColumn('uuid');
            // Add id column as primary key
            $table->id();
        });
    }
}
