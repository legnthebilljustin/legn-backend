<?php

namespace App\Http\Controllers\Credit;

use App\Http\Controllers\Controller;
use App\Http\Requests\Credit\StorePaymentRequest;

use App\Models\Credit;

class PaymentsController extends Controller
{
    public function store(StorePaymentRequest $request)
    {
        $validated = $request->validated();
        $payment = Credit\Payment::create($validated);

        $payment->refresh();
        
        return response()->json([
            "message" => "Payment has been made."
        ], 200);
    }

    public function destroy($uuid)
    {
        Credit\Payment::find($uuid)->delete();

        // TODO: code here to adjust credit card outstanding balance.

        return response()->json([
            "message" => "Payment has been deleted."
        ], 200);
    }
}
