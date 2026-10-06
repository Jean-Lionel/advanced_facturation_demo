<?php

namespace App\Http\Controllers;

use App\Http\Requests\BanqueStoreRequest;
use App\Http\Requests\BanqueUpdateRequest;
use App\Models\Banque;
use Illuminate\Http\Request;

class BanqueController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            abort_unless(filter_var(env('APP_USE_BANQUE', false), FILTER_VALIDATE_BOOLEAN), 404);

            return $next($request);
        });
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banques = Banque::latest()->paginate(20);

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
        $data = $request->validated();
        $data['user_id'] = auth()->id() ?? 1;
        $data['is_active'] = $request->boolean('is_active');

        $banque = Banque::create($data);

        $request->session()->flash('banque.id', $banque->id);

        return redirect()->route('banque.index')->with('success', 'Banque enregistrée avec succès.');
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
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        $banque->update($data);

        $request->session()->flash('banque.id', $banque->id);

        return redirect()->route('banque.index')->with('success', 'Banque modifiée avec succès.');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Banque $banque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Banque $banque)
    {
        $banque->delete();

        return redirect()->route('banque.index')->with('success', 'Banque supprimée avec succès.');
    }
}
