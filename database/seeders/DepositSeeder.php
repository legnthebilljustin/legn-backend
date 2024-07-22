<?php

namespace Database\Seeders;

use App\Models\Crypto\Deposit;
use Illuminate\Database\Seeder;

class DepositSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Deposit::factory()->count(10)->create();
    }
}
