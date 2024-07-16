<?php

namespace Tests\Feature;

use App\Enums\RoutePathsEnum;
use App\Models\Crypto\Crypto;
use App\Models\User;
use Database\Seeders\CryptoSeeder;
use Database\Seeders\CryptoWithTradesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TradesTest extends TestCase
{
    use RefreshDatabase;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user, "sanctum");
    }

    public function test_create_trade()
    {
        $this->seed(CryptoSeeder::class);

        $response = $this->getJson(RoutePathsEnum::CRYPTO_LIST_PATH);

        $crypto = $response["data"][0];

        $formData = [
            "cryptoUuid" => $crypto["uuid"],
            "entryPrice" => 1203210,
            "amountUSD" => 10000,
            "fee" => 1212,
            "receivedCryptoAmount" => 0.1241235,
            "finalCryptoAmount" => 0.112321455,
            "tradeDate" => "2024-04-23",
        ];

        $response = $this->postJson(RoutePathsEnum::CRYPTO_TRADES_PATH, $formData);
        $response->assertStatus(200);
    }

    public function test_get_single_trade()
    {
        $this->seed(CryptoSeeder::class);
        $response = $this->getJson(RoutePathsEnum::CRYPTO_LIST_PATH);

        $crypto = $response["data"][0];

        $formData = [
            "cryptoUuid" => $crypto["uuid"],
            "entryPrice" => 1203210,
            "amountUSD" => 10000,
            "fee" => 1212,
            "receivedCryptoAmount" => 0.1241235,
            "finalCryptoAmount" => 0.112321455,
            "tradeDate" => "2024-04-23",
        ];

        $response = $this->postJson(RoutePathsEnum::CRYPTO_TRADES_PATH, $formData);
        
        $createdTradeUuid = $response["data"]["uuid"];
        
        $response = $this->getJson(RoutePathsEnum::CRYPTO_TRADES_PATH . "/" . $createdTradeUuid);
        $response->assertStatus(200);

    }

    public function test_get_all_trades_of_crypto()
    {
        $this->seed(CryptoWithTradesSeeder::class);

        $response = $this->getJson(RoutePathsEnum::CRYPTO_LIST_PATH);
        $crypto = $response["data"][0];

        $path = "/api/crypto/v1/allTrades/" . $crypto['uuid']; 

        $response = $this->getJson($path);
        $response->assertStatus(200);
    }
}
