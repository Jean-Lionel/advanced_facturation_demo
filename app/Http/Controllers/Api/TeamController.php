<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamStoreRequest;
use App\Http\Requests\TeamUpdateRequest;
use App\Http\Resources\TeamCollection;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\TeamCollection
     */
    public function index(Request $request)
    {
        $teams = Team::all();

        return new TeamCollection($teams);
    }

    /**
     * @param \App\Http\Requests\TeamStoreRequest $request
     * @return \App\Http\Resources\TeamResource
     */
    public function store(TeamStoreRequest $request)
    {
        $team = Team::create($request->validated());

        return new TeamResource($team);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Team $team
     * @return \App\Http\Resources\TeamResource
     */
    public function show(Request $request, Team $team)
    {
        return new TeamResource($team);
    }

    /**
     * @param \App\Http\Requests\TeamUpdateRequest $request
     * @param \App\Models\Team $team
     * @return \App\Http\Resources\TeamResource
     */
    public function update(TeamUpdateRequest $request, Team $team)
    {
        $team->update($request->validated());

        return new TeamResource($team);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Team $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Team $team)
    {
        $team->delete();

        return response()->noContent();
    }
}
