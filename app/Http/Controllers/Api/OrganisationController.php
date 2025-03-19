<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrganisationStoreRequest;
use App\Http\Requests\Api\OrganisationUpdateRequest;
use App\Http\Resources\Api\OrganisationCollection;
use App\Http\Resources\Api\OrganisationResource;
use App\Models\Organisation;
use Illuminate\Http\Request;

class OrganisationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Api\OrganisationCollection
     */
    public function index(Request $request)
    {
        $organisations = Organisation::all();

        return new OrganisationCollection($organisations);
    }

    /**
     * @param \App\Http\Requests\Api\OrganisationStoreRequest $request
     * @return \App\Http\Resources\Api\OrganisationResource
     */
    public function store(OrganisationStoreRequest $request)
    {
        $organisation = Organisation::create($request->validated());

        return new OrganisationResource($organisation);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Organisation $organisation
     * @return \App\Http\Resources\Api\OrganisationResource
     */
    public function show(Request $request, Organisation $organisation)
    {
        return new OrganisationResource($organisation);
    }

    /**
     * @param \App\Http\Requests\Api\OrganisationUpdateRequest $request
     * @param \App\Models\Organisation $organisation
     * @return \App\Http\Resources\Api\OrganisationResource
     */
    public function update(OrganisationUpdateRequest $request, Organisation $organisation)
    {
        $organisation->update($request->validated());

        return new OrganisationResource($organisation);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Organisation $organisation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Organisation $organisation)
    {
        $organisation->delete();

        return response()->noContent();
    }
}
