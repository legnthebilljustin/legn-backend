<?php

namespace Tests\Feature;

use App\Enums\RoutePathsEnum;
use App\Models\User;
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

    public function test_get_single_trade()
    {
        $response = $this->getJson(RoutePathsEnum::CRYPTO_TRADES_PATH . "/awdsadwadsa");

        $response->assertStatus(200);
    }
}
