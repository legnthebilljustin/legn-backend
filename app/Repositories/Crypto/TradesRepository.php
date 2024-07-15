<?php

namespace App\Repositories\Crypto;

use App\Models\Crypto\Trade;
use Illuminate\Support\ItemNotFoundException;

class TradesRepository
{
    public function doesTradeExist(Trade $trade): void
    {   // i think this should be a service that can be used by all controllers
        if (!$trade) {
            throw new ItemNotFoundException("Requested trade not found.", 404);
        }
    }

    public function updateTrade(Trade $trade, $validatedTrade): Trade
    {

        return $trade;
    }
}