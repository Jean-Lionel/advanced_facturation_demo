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
     *
     */
    public function index(Request $request)
    {
        $organisations = Organisation::all();
        if ($request->wantsJson()) {
            return $organisations;
        }

        return view('organisations.index', [
            'organisations' => $organisations
        ]);

    }
    public function create()
    {
        return view('organisations.create');
    }

    /**
     * Edit the specified resource.
     *
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function edit(Organisation $organisation)
    {
        return view('organisations.edit', [
            'organisation' => $organisation
        ]);
    }
    /**
     * @param \App\Http\Requests\Api\OrganisationStoreRequest $request
     * @return \App\Http\Resources\Api\OrganisationResource
     */
    public function store(OrganisationStoreRequest $request)
    {
        $organisation = Organisation::create(array_merge($request->validated(), ['user_id' => auth()->user()->id]));
        if ($request->wantsJson()) {
            return new OrganisationResource($organisation);
        }

        return view('organisations.show', [
            'organisation' => $organisation
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Organisation $organisation
     * @return \App\Http\Resources\Api\OrganisationResource
     */
    public function show(Request $request, Organisation $organisation)
    {
        if ($request->wantsJson()) {
            return new OrganisationResource($organisation);
        }

        return view('organisations.show', [
            'organisation' => $organisation
        ]);
    }

    /**
     * @param \App\Http\Requests\Api\OrganisationUpdateRequest $request
     * @param \App\Models\Organisation $organisation
     * @return \App\Http\Resources\Api\OrganisationResource
     */
    public function update(OrganisationUpdateRequest $request, Organisation $organisation)
    {
        $organisation->update($request->validated());

        if ($request->wantsJson()) {
            return new OrganisationResource($organisation);
        }

        return view('organisations.show', [
            'organisation' => $organisation
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Organisation $organisation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Organisation $organisation)
    {
       // $organisation->delete();

        if ($request->wantsJson()) {
            return response()->noContent();
        }

        return redirect()->route('organisations.index');
    }
}
