<?php

namespace App\Repositories\Crypto;

use App\Models\Crypto\Trade;
use App\Services\CurrencyService;
use Illuminate\Support\ItemNotFoundException;

class TradesRepository
{
    protected $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function doesTradeExist(Trade $trade): void
    {   // i think this should be a service that can be used by all controllers
        if (!$trade) {
            throw new ItemNotFoundException("Requested trade not found.", 404);
        }
    }

    public function saveTrade(array $validatedTrade)
    {
        $propertiesToConvert = ["amountUSD", "entryPrice"];
        $converted = $this->currencyService->convertToCents($validatedTrade, $propertiesToConvert);

        $trade = Trade::create($converted);

        return $trade;
    }

    public function updateTrade(Trade $trade, $validatedTrade): Trade
    {

        return $trade;
    }
}