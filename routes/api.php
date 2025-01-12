<?php

use App\Http\Controllers\Credit;
use App\Http\Controllers\Crypto;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(["prefix" => "auth"], function() {
    Route::post("login", [AuthController::class, "login"]);
});

Route::middleware('auth:sanctum')->group(function() {

    Route::group(["prefix" => "/credit"], function() {

        Route::group(["prefix" => "/v1"], function() {

            Route::group(["prefix" => "/transactions"], function() {
                Route::get("/afterBillingDate/{creditCardUuid}", [Credit\TransactionsController::class, "afterBillingDate"]);
            });

            Route::apiResources([
                "cards" => Credit\CreditCardsController::class,
                "transactionCategories" => Credit\TransactionCategoriesController::class,
                "transactions" => Credit\TransactionsController::class,
                "rewardMultipliers" => Credit\RewardMultipliersController::class,
                "payments" => Credit\PaymentsController::class,
            ]);

            Route::get("/allTransactionsByCard/{creditCardUuid}", [Credit\TransactionsController::class, "allTransactionsByCard"]);

            Route::group(["prefix" => "/statements"], function() {
                Route::get("/statementsByCard/{creditCardUuid}", [Credit\StatementsController::class, "getStatementsByCard"]);
                Route::get("/transactionsAndPayments/{statementUuid}", [Credit\StatementsController::class, "getStatementTransactionsAndPayments"]);
                Route::post("/create", [Credit\StatementsController::class, "createStatement"]);
            });
        });
    });

    Route::group(["prefix" => "/crypto"], function() {
        Route::group(["prefix" => "/v1"], function() {
            Route::apiResource("/trades", Crypto\TradesController::class, ["except" => "index"]);
            Route::apiResources([
                "deposits" => Crypto\DepositsController::class,
                "cryptos" => Crypto\CryptosController::class
            ]);

            Route::get("/allTrades/{crypto}", [Crypto\CryptosController::class, "getAllTradesByCrypto"]);
        });
    });
});
