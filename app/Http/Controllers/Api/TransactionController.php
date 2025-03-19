<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TransactionStoreRequest;
use App\Http\Requests\Api\TransactionUpdateRequest;
use App\Http\Resources\Api\TransactionCollection;
use App\Http\Resources\Api\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Api\TransactionCollection
     */
    public function index(Request $request)
    {
        $transactions = Transaction::with(['transactionType'])->latest()->paginate();

        return $transactions;
    }

    /**
     * @param \App\Http\Requests\Api\TransactionStoreRequest $request
     * @return \App\Http\Resources\Api\TransactionResource
     */
    public function store(TransactionStoreRequest $request)
    {
        $transaction = Transaction::create($request->validated());

        return new TransactionResource($transaction);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Transaction $transaction
     * @return \App\Http\Resources\Api\TransactionResource
     */
    public function show(Request $request, Transaction $transaction)
    {
        return new TransactionResource($transaction);
    }

    /**
     * @param \App\Http\Requests\Api\TransactionUpdateRequest $request
     * @param \App\Models\Transaction $transaction
     * @return \App\Http\Resources\Api\TransactionResource
     */
    public function update(TransactionUpdateRequest $request, Transaction $transaction)
    {
        $transaction->update($request->validated());

        return new TransactionResource($transaction);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Transaction $transaction)
    {
        $transaction->delete();

        return response()->noContent();
    }
}
