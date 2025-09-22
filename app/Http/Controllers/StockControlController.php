<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockControlStoreRequest;
use App\Http\Requests\StockControlUpdateRequest;
use App\Models\StockControl;

use App\Models\ObrMouvementStock;
use App\Models\Product;
use Illuminate\Http\Request;

class StockControlController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $stockControls = StockControl::all();

        return view('stockControl.index', compact('stockControls'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('stockControl.create');
    }

    /**
     * @param \App\Http\Requests\StockControlStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StockControlStoreRequest $request)
    {
        $stockControl = StockControl::create($request->validated());

        $request->session()->flash('stockControl.id', $stockControl->id);

        return redirect()->route('stockControl.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\StockControl $stockControl
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, StockControl $stockControl)
    {
        return view('stockControl.show', compact('stockControl'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\StockControl $stockControl
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, StockControl $stockControl)
    {
        return view('stockControl.edit', compact('stockControl'));
    }

    /**
     * @param \App\Http\Requests\StockControlUpdateRequest $request
     * @param \App\Models\StockControl $stockControl
     * @return \Illuminate\Http\Response
     */
    public function update(StockControlUpdateRequest $request, StockControl $stockControl)
    {
        $stockControl->update($request->validated());

        $request->session()->flash('stockControl.id', $stockControl->id);

        return redirect()->route('stockControl.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\StockControl $stockControl
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, StockControl $stockControl)
    {
        $stockControl->delete();

        return redirect()->route('stockControl.index');
    }

    public function annulerSortie(StockControl $stockControl){

        try {

            \DB::beginTransaction();
            //code...
            $product = Product::findOrFail($stockControl->product_id);
            // dd($product);
            $oldQuantite = $stockControl->sold_quantity ?? 0;
            $soldQuantity = $product->quantite + $oldQuantite;

            $product->quantite = $soldQuantity;

            $product->save();

            ObrMouvementStock::saveMouvement($product, 'ER', $product->prix_vente, $soldQuantity, 'Controle du ' . date('Y-m-d'), $stockControl->id);
            $stockControl->delete();
             \DB::commit();
            session()->flash('success', 'Stock mis à jour pour ' . $product->name);
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;p
            \DB::rollBack();
            session()->flash('error', 'Erreur lors de la mise à jour du stock'.$th);
            return redirect()->back();
        }


    }
}
