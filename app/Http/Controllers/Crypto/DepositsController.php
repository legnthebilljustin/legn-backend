<?php

namespace App\Http\Controllers\Crypto;

use App\Http\Controllers\Controller;
use App\Http\Requests\Crypto\StoreDepositsRequest;
use App\Http\Resources\DepositsResource;
use App\Models\Crypto\Deposit;
use App\Services\CurrencyService;
use Illuminate\Http\Request;
use InvalidArgumentException;

class DepositsController extends Controller
{
    protected $currencyService;
    
    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deposits = Deposit::orderBy("depositDate", "desc")->get();

        $totalDepositAmount = $deposits->sum("depositAmount");

        $resource = DepositsResource::collection($deposits);

        return response()->json([
            "totalDepositAmount" => $totalDepositAmount,
            "deposits" => $resource
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepositsRequest $request)
    {
        $validated = $request->validated();

        // convert currency to cents
        $propertiesToConvert = [
            "depositAmount", "fee", "exchangePrice", "totalAmount"
        ];

        $converted = $this->currencyService->convertToCents($validated, $propertiesToConvert);

        $newDeposit = Deposit::create($converted);
        $resource = new DepositsResource($newDeposit);

        return response()->json([
            "data" => $resource
        ]);
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
    public function destroy(Deposit $deposit)
    {
        if (!$deposit) {
            throw new InvalidArgumentException("Deposit not found!", 404);
        }
        
        $deposit->delete();

        return response()->json([
            "message" => "Deposit deleted."
        ]);
    }
}
