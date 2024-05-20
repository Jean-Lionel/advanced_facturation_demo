<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommissionDetailStoreRequest;
use App\Http\Requests\CommissionDetailUpdateRequest;
use App\Models\CommissionDetail;
use Illuminate\Http\Request;

class CommissionDetailController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $commissionDetails = CommissionDetail::all();

        return view('commissionDetail.index', compact('commissionDetails'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('commissionDetail.create');
    }

    /**
     * @param \App\Http\Requests\CommissionDetailStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommissionDetailStoreRequest $request)
    {
        $commissionDetail = CommissionDetail::create($request->validated());

        $request->session()->flash('commissionDetail.id', $commissionDetail->id);

        return redirect()->route('commissionDetail.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CommissionDetail $commissionDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CommissionDetail $commissionDetail)
    {
        return view('commissionDetail.show', compact('commissionDetail'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CommissionDetail $commissionDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, CommissionDetail $commissionDetail)
    {
        return view('commissionDetail.edit', compact('commissionDetail'));
    }

    /**
     * @param \App\Http\Requests\CommissionDetailUpdateRequest $request
     * @param \App\Models\CommissionDetail $commissionDetail
     * @return \Illuminate\Http\Response
     */
    public function update(CommissionDetailUpdateRequest $request, CommissionDetail $commissionDetail)
    {
        $commissionDetail->update($request->validated());

        $request->session()->flash('commissionDetail.id', $commissionDetail->id);

        return redirect()->route('commissionDetail.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CommissionDetail $commissionDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CommissionDetail $commissionDetail)
    {
        $commissionDetail->delete();

        return redirect()->route('commissionDetail.index');
    }
}
