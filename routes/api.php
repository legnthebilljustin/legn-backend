<?php

use App\Http\Controllers\Credit;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
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

Route::get("/test", function() {
    return "hello";
});



Route::group(["prefix" => "auth"], function() {
    Route::post("login", [AuthController::class, "login"]);
    Route::post("register", [AuthController::class, "register"]);
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
});
