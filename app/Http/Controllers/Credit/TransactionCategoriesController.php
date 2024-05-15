<?php

namespace App\Http\Controllers\Credit;

use App\Http\Controllers\Controller;
use App\Http\Requests\Credit\StoreTransactionCategoryRequest;
use App\Http\Requests\Credit\UpdateTransactionCategoryRequest;
use Illuminate\Http\Request;
use App\Models\Credit;
use App\Repositories\Credit\TransactionCategoryRepository;

class TransactionCategoriesController extends Controller
{
    private $transactionCategoryRepo;

    public function __construct(TransactionCategoryRepository $transactionCategoryRepository)
    {
        $this->transactionCategoryRepo = $transactionCategoryRepository;
    }

    public function index()
    {
        return Credit\TransactionCategory::all();
    }

    public function store(StoreTransactionCategoryRequest $request)
    {
        $validated = $request->validated();

        Credit\TransactionCategory::create($validated);

        return response()->json(["message" => "Transaction category has been created."], 200);
    }

    public function update(UpdateTransactionCategoryRequest $request, $uuid)
    {
        $validated = $request->validated();
        $category = $this->transactionCategoryRepo->updateCategory($uuid, $validated);

        return response()->json([
            "message" => "Transaction category has been updated.",
            "category" => $category
        ]);
    }

    public function destroy($uuid)
    {
        $category = Credit\TransactionCategory::where("uuid", $uuid)->firstOrFail();
        $category->delete();

        return response()->json([
            "message" => "Transaction category deleted."
        ], 200);
    }
}
