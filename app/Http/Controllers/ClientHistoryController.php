<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientHistoryStoreRequest;
use App\Http\Requests\ClientHistoryUpdateRequest;
use App\Models\ClientHistory;
use Illuminate\Http\Request;

class ClientHistoryController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clientHistories = ClientHistory::all();

        return view('clientHistory.index', compact('clientHistories'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('clientHistory.create');
    }

    /**
     * @param \App\Http\Requests\ClientHistoryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientHistoryStoreRequest $request)
    {
        $clientHistory = ClientHistory::create($request->validated());

        $request->session()->flash('clientHistory.id', $clientHistory->id);

        return redirect()->route('clientHistory.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ClientHistory $clientHistory
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ClientHistory $clientHistory)
    {
        return view('clientHistory.show', compact('clientHistory'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ClientHistory $clientHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ClientHistory $clientHistory)
    {
        return view('clientHistory.edit', compact('clientHistory'));
    }

    /**
     * @param \App\Http\Requests\ClientHistoryUpdateRequest $request
     * @param \App\Models\ClientHistory $clientHistory
     * @return \Illuminate\Http\Response
     */
    public function update(ClientHistoryUpdateRequest $request, ClientHistory $clientHistory)
    {
        $clientHistory->update($request->validated());

        $request->session()->flash('clientHistory.id', $clientHistory->id);

        return redirect()->route('clientHistory.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ClientHistory $clientHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ClientHistory $clientHistory)
    {
        $clientHistory->delete();

        return redirect()->route('clientHistory.index');
    }
}
