<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TransactionTypeStoreRequest;
use App\Http\Requests\Api\TransactionTypeUpdateRequest;
use App\Http\Resources\Api\TransactionTypeCollection;
use App\Http\Resources\Api\TransactionTypeResource;
use App\Models\TransactionType;
use Illuminate\Http\Request;

class TransactionTypeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Api\TransactionTypeCollection
     */
    public function index(Request $request)
    {
        $transactionTypes = TransactionType::all();

        return new TransactionTypeCollection($transactionTypes);
    }

    /**
     * @param \App\Http\Requests\Api\TransactionTypeStoreRequest $request
     * @return \App\Http\Resources\Api\TransactionTypeResource
     */
    public function store(TransactionTypeStoreRequest $request)
    {
        $transactionType = TransactionType::create($request->validated());

        return new TransactionTypeResource($transactionType);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TransactionType $transactionType
     * @return \App\Http\Resources\Api\TransactionTypeResource
     */
    public function show(Request $request, TransactionType $transactionType)
    {
        return new TransactionTypeResource($transactionType);
    }

    /**
     * @param \App\Http\Requests\Api\TransactionTypeUpdateRequest $request
     * @param \App\Models\TransactionType $transactionType
     * @return \App\Http\Resources\Api\TransactionTypeResource
     */
    public function update(TransactionTypeUpdateRequest $request, TransactionType $transactionType)
    {
        $transactionType->update($request->validated());

        return new TransactionTypeResource($transactionType);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TransactionType $transactionType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TransactionType $transactionType)
    {
        $transactionType->delete();

        return response()->noContent();
    }
}
