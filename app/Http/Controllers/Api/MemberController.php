<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MemberStoreRequest;
use App\Http\Requests\Api\MemberUpdateRequest;
use App\Http\Resources\Api\MemberCollection;
use App\Http\Resources\Api\MemberResource;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Api\MemberCollection
     */
    public function index(Request $request)
    {
        $members = Member::all();

        return new MemberCollection($members);
    }

    /**
     * @param \App\Http\Requests\Api\MemberStoreRequest $request
     * @return \App\Http\Resources\Api\MemberResource
     */
    public function store(MemberStoreRequest $request)
    {
        $member = Member::create($request->validated());

        return new MemberResource($member);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Member $member
     * @return \App\Http\Resources\Api\MemberResource
     */
    public function show(Request $request, Member $member)
    {
        return new MemberResource($member);
    }

    /**
     * @param \App\Http\Requests\Api\MemberUpdateRequest $request
     * @param \App\Models\Member $member
     * @return \App\Http\Resources\Api\MemberResource
     */
    public function update(MemberUpdateRequest $request, Member $member)
    {
        $member->update($request->validated());

        return new MemberResource($member);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Member $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Member $member)
    {
        $member->delete();

        return response()->noContent();
    }
}
