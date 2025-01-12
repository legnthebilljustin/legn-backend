<?php

namespace Tests\Feature;

use App\Enums\RoutePathsEnum;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DepositsTest extends TestCase
{
    use RefreshDatabase;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user, "sanctum");
    }

    public function test_get_deposits()
    {
        $response = $this->getJson(RoutePathsEnum::CRYPTO_DEPOSIT_PATH);

        $response->assertStatus(200);
    }

    public function test_get_deposits_total_amount()
    {
        $response = $this->getJson(RoutePathsEnum::CRYPTO_DEPOSIT_PATH);
        $response->assertStatus(200);
    }

    public function test_create_deposit()
    {
        $formData = [
            "depositAmount" => 1000.00,
            "fee" => 25,
            "exchangeToken" => "USDT",
            "exchangePrice" => 51.29,
            "totalAmount" => 12451.32,
            "depositDate" => "2024-02-01"
        ];

        $response = $this->postJson(RoutePathsEnum::CRYPTO_DEPOSIT_PATH, $formData);

        $response->assertStatus(200);
    }

    public function test_create_deposit_with_incorrect_datatype()
    {
        $formData = [
            "depositAmount" => "one hundred",
            "fee" => 25.00,
            "exchangeToken" => "USDT",
            "exchangePrice" => 51.29,
            "totalAmount" => 12451.32,
            "depositDate" => "2024-02-01"
        ];

        $response = $this->postJson(RoutePathsEnum::CRYPTO_DEPOSIT_PATH, $formData);

        $response->assertStatus(422);
    }

    public function test_delete_deposit()
    {
        $formData = [
            "depositAmount" => 1000.00,
            "fee" => 25,
            "exchangeToken" => "USDT",
            "exchangePrice" => 51.29,
            "totalAmount" => 12451.32,
            "depositDate" => "2024-02-01"
        ];

        $response = $this->postJson(RoutePathsEnum::CRYPTO_DEPOSIT_PATH, $formData);

        $response = $this->deleteJson(RoutePathsEnum::CRYPTO_DEPOSIT_PATH . '/' . $response["data"]["uuid"]);
        $response->assertStatus(200);
    }

    public function test_delete_not_existing_deposit()
    {
        $response = $this->deleteJson(RoutePathsEnum::CRYPTO_DEPOSIT_PATH . '/' . "wadsanajn2kjen2");

        $response->assertStatus(404);
    }
}
