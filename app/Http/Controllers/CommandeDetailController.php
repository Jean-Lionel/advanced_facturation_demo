<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommandeDetailStoreRequest;
use App\Http\Requests\CommandeDetailUpdateRequest;
use App\Models\CommandeDetail;
use Illuminate\Http\Request;

class CommandeDetailController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $commandeDetails = CommandeDetail::all();

        return view('commandeDetail.index', compact('commandeDetails'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('commandeDetail.create');
    }

    /**
     * @param \App\Http\Requests\CommandeDetailStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommandeDetailStoreRequest $request)
    {
        $commandeDetail = CommandeDetail::create($request->validated());

        $request->session()->flash('commandeDetail.id', $commandeDetail->id);

        return redirect()->route('commandeDetail.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CommandeDetail $commandeDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CommandeDetail $commandeDetail)
    {
        return view('commandeDetail.show', compact('commandeDetail'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CommandeDetail $commandeDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, CommandeDetail $commandeDetail)
    {
        return view('commandeDetail.edit', compact('commandeDetail'));
    }

    /**
     * @param \App\Http\Requests\CommandeDetailUpdateRequest $request
     * @param \App\Models\CommandeDetail $commandeDetail
     * @return \Illuminate\Http\Response
     */
    public function update(CommandeDetailUpdateRequest $request, CommandeDetail $commandeDetail)
    {
        $commandeDetail->update($request->validated());

        $request->session()->flash('commandeDetail.id', $commandeDetail->id);

        return redirect()->route('commandeDetail.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CommandeDetail $commandeDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CommandeDetail $commandeDetail)
    {
        $commandeDetail->delete();

        return redirect()->route('commandeDetail.index');
    }
}
