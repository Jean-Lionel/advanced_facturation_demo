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
    public function index(Request $request)
    {
        $transaction_types = TransactionType::latest()->paginate();

        if ($request->wantsJson()) {
            return new TransactionTypeCollection($transaction_types);
        }

        return view('transaction_types.index', compact('transaction_types'));
    }

    public function create()
    {
        return view('transaction_types.create');
    }

    public function store(TransactionTypeStoreRequest $request)
    {
        $transaction_type = TransactionType::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->user()->id
        ]);

        if ($request->wantsJson()) {
            return new TransactionTypeResource($transaction_type);
        }

        return redirect()->route('advanced.transaction_types.index')
            ->with('success', 'Type de transaction créé avec succès');
    }

    public function show(Request $request, TransactionType $transaction_type)
    {
        if ($request->wantsJson()) {
            return new TransactionTypeResource($transaction_type);
        }

        return view('transaction_types.show', compact('transaction_type'));
    }

    public function edit(TransactionType $transaction_type)
    {
        return view('transaction_types.edit', compact('transaction_type'));
    }

    public function update(TransactionTypeUpdateRequest $request, TransactionType $transaction_type)
    {
        $transaction_type->update([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->user()->id
        ]);

        if ($request->wantsJson()) {
            return new TransactionTypeResource($transaction_type);
        }

        return redirect()->route('advanced.transaction_types.index')
            ->with('success', 'Type de transaction mis à jour avec succès');
    }

    public function destroy(Request $request, TransactionType $transaction_type)
    {
        $transaction_type->delete();

        if ($request->wantsJson()) {
            return response()->noContent();
        }

        return redirect()->route('advanced.transaction_types.index')
            ->with('success', 'Type de transaction supprimé avec succès');
    }
}
