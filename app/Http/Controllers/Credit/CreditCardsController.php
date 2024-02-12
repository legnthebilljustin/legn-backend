<?php

namespace App\Http\Controllers\Credit;

use App\Http\Controllers\Controller;
use App\Http\Requests\Credit\StoreCreditCardRequest;
use App\Http\Resources\CreditCardResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Credit;

class CreditCardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = Credit\CreditCard::all();
        $creditCardResources = CreditCardResource::collection($cards);
        return response()->json($creditCardResources, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreditCardRequest $request)
    {
        $validated = $request->validated();
        $card = Credit\CreditCard::create($validated);

        $card->refresh();
        $creditCardResource = new CreditCardResource($card);
        
        return response()->json($creditCardResource, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $card = Credit\CreditCard::find($uuid);
        $resource = new CreditCardResource($card);

        return response()->json($resource, 200);
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
