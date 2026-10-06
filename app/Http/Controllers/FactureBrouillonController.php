<?php

namespace App\Http\Controllers;

use App\Models\FactureBrouillon;

class FactureBrouillonController extends Controller
{
    public function index()
    {
        $search = trim((string) request()->query('search'));

        $brouillons = FactureBrouillon::with('user')
        ->when($search, function($query) use ($search){
            $query->where(function($q) use ($search){
                $q->where('client_name', 'like', "%{$search}%")
                  ->orWhere('id', $search);
            });
        })
        ->latest('updated_at')->paginate()->withQueryString();

        return view('ventes.brouillons', [
            'brouillons' => $brouillons,
            'search' => $search,
        ]);
    }

    public function destroy(FactureBrouillon $brouillon)
    {
        $brouillon->delete();
        return redirect()->route('brouillons.index')->with('success', 'Brouillon supprimé');
    }
}
