<?php

namespace App\Http\Controllers;

use App\Http\Requests\HrFicheDetailStoreRequest;
use App\Http\Requests\HrFicheDetailUpdateRequest;
use App\Models\HrFicheDetail;
use Illuminate\Http\Request;

class HrFicheDetailController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hrFicheDetails = HrFicheDetail::all();

        return view('hrFicheDetail.index', compact('hrFicheDetails'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('hrFicheDetail.create');
    }

    /**
     * @param \App\Http\Requests\HrFicheDetailStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(HrFicheDetailStoreRequest $request)
    {
        $hrFicheDetail = HrFicheDetail::create($request->validated());

        $request->session()->flash('hrFicheDetail.id', $hrFicheDetail->id);

        return redirect()->route('hrFicheDetail.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HrFicheDetail $hrFicheDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, HrFicheDetail $hrFicheDetail)
    {
        return view('hrFicheDetail.show', compact('hrFicheDetail'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HrFicheDetail $hrFicheDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, HrFicheDetail $hrFicheDetail)
    {
        return view('hrFicheDetail.edit', compact('hrFicheDetail'));
    }

    /**
     * @param \App\Http\Requests\HrFicheDetailUpdateRequest $request
     * @param \App\Models\HrFicheDetail $hrFicheDetail
     * @return \Illuminate\Http\Response
     */
    public function update(HrFicheDetailUpdateRequest $request, HrFicheDetail $hrFicheDetail)
    {
        $hrFicheDetail->update($request->validated());

        $request->session()->flash('hrFicheDetail.id', $hrFicheDetail->id);

        return redirect()->route('hrFicheDetail.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HrFicheDetail $hrFicheDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, HrFicheDetail $hrFicheDetail)
    {
        $hrFicheDetail->delete();

        return redirect()->route('hrFicheDetail.index');
    }
}
