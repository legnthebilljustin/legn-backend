<?php

namespace App\Enums;

class RoutePathsEnum
{
    public const BASE_PATH = "/api/crypto/v1/";

    public const CRYPTO_LIST_PATH = self::BASE_PATH . "cryptos";
    public const CRYPTO_DEPOSIT_PATH = self::BASE_PATH . "deposits";
    public const CRYPTO_TRADES_PATH = self::BASE_PATH . "trades";
}