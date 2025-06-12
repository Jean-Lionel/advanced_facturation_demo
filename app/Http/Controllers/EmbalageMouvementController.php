<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmbalageMouvementStoreRequest;
use App\Http\Requests\EmbalageMouvementUpdateRequest;
use App\Models\Client;
use App\Models\Embalage;
use App\Models\EmbalageMouvement;
use Illuminate\Http\Request;

class EmbalageMouvementController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $mouvements = EmbalageMouvement::latest()->paginate();

        return view('embalage-mouvement.index', compact('mouvements'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $embalages = Embalage::all();
        $clients  = Client::all();
        return view('embalage-mouvement.create' , compact('embalages' , 'clients'));
    }

    /**
     * @param \App\Http\Requests\EmbalageMouvementStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmbalageMouvementStoreRequest $request)
    {
        $embalageMouvement = EmbalageMouvement::create($request->validated());

        $request->session()->flash('embalageMouvement.id', $embalageMouvement->id);

        return redirect()->route('embalage-mouvement.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EmbalageMouvement $embalageMouvement
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, EmbalageMouvement $embalageMouvement)
    {
        return view('embalage-mouvement.show', compact('embalageMouvement'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EmbalageMouvement $embalageMouvement
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, EmbalageMouvement $embalageMouvement)
    {
        return view('embalage-mouvement.edit', compact('embalageMouvement'));
    }

    /**
     * @param \App\Http\Requests\EmbalageMouvementUpdateRequest $request
     * @param \App\Models\EmbalageMouvement $embalageMouvement
     * @return \Illuminate\Http\Response
     */
    public function update(EmbalageMouvementUpdateRequest $request, EmbalageMouvement $embalageMouvement)
    {
        $embalageMouvement->update($request->validated());

        $request->session()->flash('embalageMouvement.id', $embalageMouvement->id);

        return redirect()->route('embalage-mouvement.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EmbalageMouvement $embalageMouvement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, EmbalageMouvement $embalageMouvement)
    {
        $embalageMouvement->delete();

        return redirect()->route('embalage-mouvement.index');
    }
}
