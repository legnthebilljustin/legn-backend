<?php

namespace App\Http\Controllers\Crypto;

use App\Http\Controllers\Controller;
use App\Http\Requests\Crypto\StoreTradeRequest;
use App\Http\Resources\TradesResource;
use App\Models\Crypto\Trade;
use App\Repositories\Crypto\TradesRepository;

class TradesController extends Controller
{

    protected $tradesRepo;

    public function __construct(TradesRepository $tradesRepository)
    {
        $this->tradesRepo = $tradesRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTradeRequest $request)
    {
        $validated = $request->validated();

        $trade = Trade::create($validated);

        $resource = new TradesResource($trade);

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
    public function show(Trade $trade)
    {
        $this->tradesRepo->doesTradeExist($trade);

        $resource = new TradesResource($trade);

        return response()->json([
            "data" => $resource
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTradeRequest $request, Trade $trade)
    {
        $this->tradesRepo->doesTradeExist($trade);

        $validated = $request->validated();

        $this->tradesRepo->updateTrade($trade, $validated);

        return response()->json([
            "data" => ""
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trade $trade)
    {
        $this->tradesRepo->doesTradeExist($trade);

        $trade->delete();

        return response()->json([
            "message" => "Trade deleted."
        ]);
    }
}
