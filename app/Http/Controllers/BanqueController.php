<?php

namespace App\Http\Controllers;

use App\Http\Requests\BanqueStoreRequest;
use App\Http\Requests\BanqueUpdateRequest;
use App\Models\Banque;
use Illuminate\Http\Request;

class BanqueController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banques = Banque::all();

        return view('banque.index', compact('banques'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('banque.create');
    }

    /**
     * @param \App\Http\Requests\BanqueStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BanqueStoreRequest $request)
    {
        $banque = Banque::create($request->validated());

        $request->session()->flash('banque.id', $banque->id);

        return redirect()->route('banque.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Banque $banque
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Banque $banque)
    {
        return view('banque.show', compact('banque'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Banque $banque
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Banque $banque)
    {
        return view('banque.edit', compact('banque'));
    }

    /**
     * @param \App\Http\Requests\BanqueUpdateRequest $request
     * @param \App\Models\Banque $banque
     * @return \Illuminate\Http\Response
     */
    public function update(BanqueUpdateRequest $request, Banque $banque)
    {
        $banque->update($request->validated());

        $request->session()->flash('banque.id', $banque->id);

        return redirect()->route('banque.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Banque $banque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Banque $banque)
    {
        $banque->delete();

        return redirect()->route('banque.index');
    }
}
