<?php

use App\Http\Controllers\Credit;
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

// Route::middleware('auth:sanctum')->group(function() {

    Route::group(["prefix" => "/credit"], function() {

        Route::group(["prefix" => "/v1"], function() {
            Route::apiResources([
                "cards" => Credit\CreditCardsController::class,
                "transactionCategories" => Credit\TransactionCategoriesController::class,
                "transactions" => Credit\TransactionsController::class,
                "rewardMultipliers" => Credit\RewardMultipliersController::class
            ]);

            Route::get("/allTransactionsByCard/{creditCardUuid}", [Credit\TransactionsController::class, "allTransactionsByCard"]);
        });
    });
// });
