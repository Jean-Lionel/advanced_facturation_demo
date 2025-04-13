<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TransactionStoreRequest;
use App\Http\Requests\Api\TransactionUpdateRequest;
use App\Http\Resources\Api\TransactionCollection;
use App\Http\Resources\Api\TransactionResource;
use App\Models\Member;
use App\Models\Transaction;
use App\Models\TransactionFile;
use App\Models\TransactionType;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Api\TransactionCollection
     */
    public function index(Request $request)
    {
        $query = Transaction::with(['transactionType', 'member', 'files'])
            ->latest();

            // Dans le contrôleur
        if ($request->has('date_debut') && $request->date_debut !== null && $request->has('date_fin') && $request->date_fin !== null) {
            $query->whereBetween('date_transaction', [
                $request->input('date_debut'),
                $request->input('date_fin')
            ]);
        }

        // Filtrer par date
        if ($request->has('date_transaction') && $request->date_transaction !== null) {
            $date = $request->input('date_transaction');
            $query->whereDate('date_transaction', $date);
        }

        // Filtrer par montant
        if ($request->has('montant') && $request->montant !== null) {
            $query->where('montant', $request->input('montant'));
        }

        // Filtrer par type de transaction
        if ($request->has('transaction_type_id') && $request->transaction_type_id !== null) {
            $query->where('transaction_type_id', $request->input('transaction_type_id'));
        }

        // Filtrer par membre
        if ($request->has('member_id') && $request->member_id !== null) {
            $query->where('member_id', $request->input('member_id'));
        }

        // Filtrer par description
        if ($request->has('description') && $request->description !== null) {
            $query->where('description', 'like', '%' . $request->input('description') . '%');
        }
        $transactions = $query->paginate(10);

        $transaction_types = TransactionType::all();
        $members = Member::all();

        if ($request->wantsJson()) {
            return new TransactionCollection($transactions);
        }

        return view('transactions.index', compact('transactions', 'transaction_types', 'members', 'members'));
    }

    /**
     * @param \App\Http\Requests\Api\TransactionStoreRequest $request
     * @return \App\Http\Resources\Api\TransactionResource
     */
    public function store(TransactionStoreRequest $request)
    {
        $transaction = Transaction::create(array_merge($request->validated(), ['user_id' => auth()->user()->id]));

        if($request->hasFile('file_item')) {
            $file = $request->file('file_item');
            $file_name = time() . "." . $file->getClientOriginalExtension();
            $file_path = $file->move('img/transactions', $file_name);
            TransactionFile::create([
                'transaction_id' => $transaction->id,
                'file_url' => $file_path,
                'user_id' => auth()->user()->id,
                'name' => $file_name
            ]);
        }
        if ($request->wantsJson()) {
            return new TransactionResource($transaction);
        }

        return redirect()->route('advanced.transactions.index')->with('success', 'Transaction created successfully');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $transaction_types = TransactionType::all();
        $members = Member::orderBy('last_name')->get();
        return view('transactions.create', compact('transaction_types', 'members'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Transaction $transaction
     * @return \App\Http\Resources\Api\TransactionResource
     */
    public function show(Request $request, Transaction $transaction)
    {
        if ($request->wantsJson()) {
            return new TransactionResource($transaction);
        }

        return view('transactions.show', compact('transaction'));
    }

    /**
     * @param \App\Http\Requests\Api\TransactionUpdateRequest $request
     * @param \App\Models\Transaction $transaction
     * @return \App\Http\Resources\Api\TransactionResource
     */
    public function update(TransactionUpdateRequest $request, Transaction $transaction)
    {
        $transaction->update($request->validated());
        if ($request->wantsJson()) {
            return new TransactionResource($transaction);
        }

        return redirect()->route('advanced.transactions.index')->with('success', 'Transaction updated successfully');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Transaction $transaction
     * @return \Illuminate\View\View
     */
    public function edit(Request $request, Transaction $transaction)
    {
        $transaction_types = TransactionType::all();
        $members = Member::orderBy('last_name')->get();
        return view('transactions.edit', compact('transaction', 'transaction_types', 'members'));
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
