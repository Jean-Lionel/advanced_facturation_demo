<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityStoreRequest;
use App\Http\Requests\ActivityUpdateRequest;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $activities = Activity::all();

        return view('activity.index', compact('activities'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('activity.create');
    }

    /**
     * @param \App\Http\Requests\ActivityStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivityStoreRequest $request)
    {
        $activity = Activity::create($request->validated());

        $request->session()->flash('activity.id', $activity->id);

        return redirect()->route('activity.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Activity $activity)
    {
        return view('activity.show', compact('activity'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Activity $activity)
    {
        return view('activity.edit', compact('activity'));
    }

    /**
     * @param \App\Http\Requests\ActivityUpdateRequest $request
     * @param \App\Models\Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function update(ActivityUpdateRequest $request, Activity $activity)
    {
        $activity->update($request->validated());

        $request->session()->flash('activity.id', $activity->id);

        return redirect()->route('activity.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Activity $activity)
    {
        $activity->delete();

        return redirect()->route('activity.index');
    }
}
