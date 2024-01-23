<?php

namespace App\Http\Controllers\Credit;

use App\Http\Controllers\Controller;
use App\Http\Requests\Credit\StoreTransactionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Credit;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        $validated = $request->validated();

        $card = Credit\CreditCard::find($validated["creditCardUuid"]);

        $category = Credit\TransactionCategory::find($validated["transactionCategoryUuid"]);
        
        $validated["rewardPoints"] = 0;

        if ($category["eligibleForPoints"]) {
            $rewardPointsMultiplier = $category->rewardMultipliers()->where("creditCardUuid", $card->uuid)->first();
            $multiplier = $rewardPointsMultiplier->multiplier;
            $initialReward = intval($validated["amount"] / $card["amountPerPoint"]);

            $validated["rewardPoints"] = $initialReward * $multiplier;
        }

        $newTransaction = DB::transaction(function() use($validated, $card) {
            $card->increment("totalTransactions");
            $card->increment("totalAmountSpent", $validated["amount"]);
            $card->increment("totalRewardPoints", $validated["rewardPoints"]);

            return Credit\CreditTransaction::create($validated);
        });

        return response()->json([
            "message" => "New credit card transaction has been added.",
            "transaction" => $newTransaction
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
