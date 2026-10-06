<?php

namespace App\Http\Controllers;

use App\Http\Requests\VersementStoreRequest;
use App\Http\Requests\VersementUpdateRequest;
use App\Models\User;
use App\Models\Versement;
use App\Models\VersementType;
use Illuminate\Http\Request;

class VersementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $versements = Versement::with(['user', 'versementType'])
            ->latest()
            ->paginate(10);

        return view('versement.index', compact('versements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $users = User::all();
        $versementTypes = VersementType::all();

        return view('versement.create', compact('users', 'versementTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\VersementStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(VersementStoreRequest $request)
    {
        $versement = Versement::create([
            'user_id' => auth()->user()->id,
            'description' => $request->description,
            'montant' => $request->montant,
            'date_transaction' => $request->date_transaction,
            'versement_type_id' => $request->versement_type_id,
        ]);

        return redirect()
            ->route('versement.index')
            ->with('success', 'Le versement a été créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Versement  $versement
     * @return \Illuminate\View\View
     */
    public function show(Versement $versement)
    {
        $versement->load(['user', 'versementType']);

        return view('versement.show', compact('versement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Versement  $versement
     * @return \Illuminate\View\View
     */
    public function edit(Versement $versement)
    {
        $users = User::all();
        $versementTypes = VersementType::all();

        return view('versement.edit', compact('versement', 'users', 'versementTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\VersementUpdateRequest  $request
     * @param  \App\Models\Versement  $versement
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(VersementUpdateRequest $request, Versement $versement)
    {
        $versement->update($request->validated());

        return redirect()
            ->route('versement.show', $versement)
            ->with('success', 'Le versement a été mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Versement  $versement
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Versement $versement)
    {
        $versement->delete();

        return redirect()
            ->route('versement.index')
            ->with('success', 'Le versement a été supprimé avec succès.');
    }
}
