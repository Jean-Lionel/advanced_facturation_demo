<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientMaisonStoreRequest;
use App\Http\Requests\ClientMaisonUpdateRequest;
use App\Models\ClientMaison;
use App\Models\Entreprise;
use App\Models\MaisonLocation;
use Barryvdh\DomPDF\Facade\Pdf;
use Faker\Provider\ar_EG\Company;
use Illuminate\Http\Request;

class ClientMaisonController extends Controller
{
    public function document_maison(){

        $months = ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"];
        $lettres = ["A", "B","C","D","E","F","G","H","I"];

        //customerName=&shop_letter=TOUS
        $customerName = request()->query('customerName');
        $shop_letter = request()->query('shop_letter');
       // dd($shop_letter, $customerName);

        if($shop_letter != null ||  $customerName != null){

            $clientMaisons = MaisonLocation::with(['clients'])
                        ->whereHas('clients')
                        ->where(function($query) use($shop_letter, $customerName){
                            if($shop_letter != null && $shop_letter != "TOUS"){
                                $query->where('name', 'like', "{$shop_letter}%");
                            }
                            if($customerName != null){
                                $query->where('name', '=', $customerName);
                            }
                        })
                        ->get()
                        ->sortBy('name')
                        ;
            $entreprise = Entreprise::currentEntreprise();

            $pdf = Pdf::loadView('maisonLocation.detailView', compact('months', 'clientMaisons', 'entreprise'));
            $pdf->setPaper('a4', 'portrait');

            $pdf->setOptions([
                'defaultFont' => 'sans-serif',
            ]);
            return $pdf->stream(time(). 'galerie_ideal.pdf');
        }





        return view('maisonLocation.document', compact('months', "lettres"));


    }
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clientMaisons = ClientMaison::all();

        return view('clientMaison.index', compact('clientMaisons'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('clientMaison.create');
    }

    /**
     * @param \App\Http\Requests\ClientMaisonStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientMaisonStoreRequest $request)
    {
        $clientMaison = ClientMaison::create($request->validated());

        $request->session()->flash('clientMaison.id', $clientMaison->id);

        return redirect()->route('clientMaison.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ClientMaison $clientMaison
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ClientMaison $clientMaison)
    {
        return view('clientMaison.show', compact('clientMaison'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ClientMaison $clientMaison
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ClientMaison $clientMaison)
    {
        return view('clientMaison.edit', compact('clientMaison'));
    }

    /**
     * @param \App\Http\Requests\ClientMaisonUpdateRequest $request
     * @param \App\Models\ClientMaison $clientMaison
     * @return \Illuminate\Http\Response
     */
    public function update(ClientMaisonUpdateRequest $request, ClientMaison $clientMaison)
    {
        $clientMaison->update($request->validated());

        $request->session()->flash('clientMaison.id', $clientMaison->id);

        return redirect()->route('clientMaison.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ClientMaison $clientMaison
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ClientMaison $clientMaison)
    {
        $clientMaison->delete();

        return redirect()->route('clientMaison.index');
    }
}
