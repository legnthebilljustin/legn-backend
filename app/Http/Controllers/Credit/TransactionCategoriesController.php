<?php

namespace App\Http\Controllers\Credit;

use App\Http\Controllers\Controller;
use App\Http\Requests\Credit\StoreTransactionCategoryRequest;
use Illuminate\Http\Request;
use App\Models\Credit;

class TransactionCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Credit\TransactionCategory::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionCategoryRequest $request)
    {
        $validated = $request->validated();

        Credit\TransactionCategory::create($validated);

        return response()->json(["message" => "Transaction category has been created."], 200);
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
    public function destroy($uuid)
    {
        $category = Credit\TransactionCategory::where("uuid", $uuid)->firstOrFail();
        $category->delete();

        return response()->json([
            "message" => "Transaction category deleted."
        ], 200);
    }
}
