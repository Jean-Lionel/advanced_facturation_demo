<?php

namespace App\Http\Controllers;

use App\Models\Proformat;
use App\Http\Requests\StoreProformatRequest;
use App\Http\Requests\UpdateProformatRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProformatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $sort = $request->get('sort', 'desc'); // desc = plus récent, asc = plus ancien

        $proformats = Proformat::when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                // Recherche par nom du client (stocké en JSON)
                $q->whereRaw("JSON_EXTRACT(client, '$.name') LIKE ?", ["%{$search}%"])
                  // Recherche par nom de service/produit (stocké en serialize)
                  ->orWhere('products', 'LIKE', "%{$search}%");
            });
        })
        ->orderBy('created_at', $sort === 'asc' ? 'asc' : 'desc')
        ->paginate(15)
        ->withQueryString();

        return view('proformats.index', compact('proformats', 'search', 'sort'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProformatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProformatRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proformat  $proformat
     * @return \Illuminate\Http\Response
     */
    public function show(Proformat $proformat)
    {
        $modelFacture = env('OBR_MODEL_FACTURE', 'MODEL_PROTHEME');
        $currentModelFacture = 'cart.facture_model_prothem';
        if($modelFacture){
            $currentModelFacture = 'cart.facture_' . Str::lower($modelFacture);
        }
        $order = $proformat;
        return view( $currentModelFacture ,compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proformat  $proformat
     * @return \Illuminate\Http\Response
     */
    public function edit(Proformat $proformat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProformatRequest  $request
     * @param  \App\Models\Proformat  $proformat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProformatRequest $request, Proformat $proformat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proformat  $proformat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proformat $proformat)
    {
        $proformat->delete();

        return redirect()->route('proformats.index')
            ->with('success', 'Proforma supprimé avec succès.');
    }
}
