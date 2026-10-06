<?php

namespace App\Http\Controllers;

use App\Models\AssuranceClient;
use App\Models\Assurance;
use App\Models\Client;
use Illuminate\Http\Request;

class AssuranceClientController extends Controller
{
    //

    public function index()
    {
        $assuranceClients = AssuranceClient::with(['client', 'assurance'])->latest()->paginate(25);
        return view('assurance_clients.index', compact('assuranceClients'));
    }

    public function create(Request $request)
    {
        $clients = Client::orderBy('name')->get();
        $assurances = Assurance::orderBy('name')->get();
        // Check for 'client_id' in query string or route parameters.
        // If the user uses route('assurance_clients.create', $id), it might come as a query param if not defined in route.
        // We'll check for 'client' or 'client_id'.
        $selected_client_id = $request->input('client_id') ?? $request->input('client');

        // If the user passed it as a non-named parameter in route(), it might be in the query string as ?123.
        // But let's assume they might fix it to ['client_id' => $id] or we can look at keys.
        if (!$selected_client_id && count($request->query()) > 0) {
             // Fallback: take the first query parameter key if it's numeric, or value.
             // This is a bit hacky but helps if they did route(..., $id).
             // Actually, let's just stick to 'client_id' and I'll update the view link to be explicit if needed.
             // For now, I'll trust they might pass it correctly or I'll update the view link later.
        }

        return view('assurance_clients.create', compact('clients', 'assurances', 'selected_client_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'assurance_id' => 'required|exists:assurances,id',
            'expire_date' => 'required|date',
            'par_client' => 'required|numeric',
            'par_assurance' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        AssuranceClient::create($request->all());

        return redirect()->route('assurance_clients.index')
            ->with('success', 'Assurance client créée avec succès.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $assuranceClient = AssuranceClient::findOrFail($id);
        $clients = Client::orderBy('name')->get();
        $assurances = Assurance::orderBy('name')->get();
        return view('assurance_clients.edit', compact('assuranceClient', 'clients', 'assurances'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'assurance_id' => 'required|exists:assurances,id',
            'expire_date' => 'required|date',
            'par_client' => 'required|numeric',
            'par_assurance' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $assuranceClient = AssuranceClient::findOrFail($id);
        $assuranceClient->update($request->all());

        return redirect()->route('assurance_clients.index')
            ->with('success', 'Assurance client mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $assuranceClient = AssuranceClient::findOrFail($id);
        $assuranceClient->delete();

        return redirect()->route('assurance_clients.index')
            ->with('success', 'Assurance client supprimée avec succès.');
    }
}
