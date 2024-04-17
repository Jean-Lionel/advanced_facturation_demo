<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompteStoreRequest;
use App\Http\Requests\CompteUpdateRequest;
use App\Models\Client;
use App\Models\Compte;
use App\Models\BienvenuHistorique;
use Illuminate\Http\Request;

class CompteController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients = Client::with('compte')->whereHas('compte')->latest()->paginate(20);

        return view('compte.index', compact('clients'));
    }

    // View formulaire de recharge
    public function recharge($id){
        
        return view('compte.recharge')->with('id', $id);
    }
    
    // View de historique des transaction
    public function historique(Request $request,$id){
        $historiques = BienvenuHistorique::where('client_id', $id)->get();
        return view('compte.historique', compact('historiques'));
    }
    
    public function updatecompte(Request $request){

        $request->validate([
            "montant" => "required",
            "type_paiement" => "required",
        ]);
        $montant = $request->montant;
        

        $modePaiement = $request->type_paiement;
        $id= $request->id;
        $compte = Compte::find($id);
        $montantActuel = $compte->montant;
        $MontTotal = $montantActuel + $montant;
        Compte::where('id', $id)->update(['montant' => $MontTotal]);
       
        
        BienvenuHistorique::create([
            'compte_id'=>$id,
            'client_id'=>$compte->client_id,
            'mode_payement'=>$modePaiement,
            'title'=>'Depot',
            'montant'=>$montant,
            'description'=>"Recharge de {$montant}",
        ]);

        $clients = Client::with('compte')->whereHas('compte')->latest()->paginate(20);
        return view('compte.index', compact('clients'));
    }


    public function syncronize_customer(){
        $clients = Client::doesntHave('compte')->get();

        foreach ($clients as $client) {
            $compte = new Compte();
            $compte->client_id = $client->id;
            $compte->name = str_pad($client->id, 4, '0', STR_PAD_LEFT);
            $compte->is_active = true;
            $compte->montant = 0;
            $compte->save();
        }
        return redirect()->back()->with('succes_message',  $clients->count() . ' comptes  ont été ajoutés');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('compte.create');
    }

    /**
     * @param \App\Http\Requests\CompteStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompteStoreRequest $request)
    {
        $compte = Compte::create($request->validated());

        $request->session()->flash('compte.id', $compte->id);

        return redirect()->route('compte.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Compte $compte
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Compte $compte)
    {
        return view('compte.show', compact('compte'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Compte $compte
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Compte $compte)
    {
        return view('compte.edit', compact('compte'));
    }

    /**
     * @param \App\Http\Requests\CompteUpdateRequest $request
     * @param \App\Models\Compte $compte
     * @return \Illuminate\Http\Response
     */
    public function update(CompteUpdateRequest $request, Compte $compte)
    {
        $compte->update($request->validated());

        $request->session()->flash('compte.id', $compte->id);

        return redirect()->route('compte.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Compte $compte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Compte $compte)
    {
        $compte->delete();

        return redirect()->route('compte.index');
    }
}