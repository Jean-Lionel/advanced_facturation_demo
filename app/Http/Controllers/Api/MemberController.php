<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MemberStoreRequest;
use App\Http\Requests\Api\MemberUpdateRequest;
use App\Http\Resources\Api\MemberCollection;
use App\Http\Resources\Api\MemberResource;
use App\Models\Member;
use App\Models\Organisation;
use Illuminate\Http\Request;


class MemberController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Api\MemberCollection
     */
    public function index(Request $request)
    {
        $members = Member::latest()->paginate();

        if ($request->wantsJson()) {
            return new MemberCollection($members);
        }

        return view('members.index', compact('members'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $organisations = Organisation::all();
        return view('members.create', compact('organisations'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Member $member
     * @return \Illuminate\View\View
     */
    public function edit(Request $request, Member $member)
    {
        return view('members.edit', compact('member'));
    }
    /**
     * @param \App\Http\Requests\Api\MemberStoreRequest $request
     * @return \App\Http\Resources\Api\MemberResource
     */
    public function store(MemberStoreRequest $request)
    {

        $member = Member::create(
            array_merge($request->validated(), [
                'user_id' => auth()->user()->id,
                'is_active' => $request->is_active == 'on' ? true : false,
            ])
        );

        if($request->hasFile('profile_image')) {
            $profile_image = $request->file('profile_image');
            $image_name = time() . "." . $profile_image->getClientOriginalExtension();
            $path = $request->file('profile_image')->move('img/profile_images', $image_name);
            $member->profile_image =  $path;
        }

        $member->save();

        if ($request->wantsJson()) {
            return new MemberResource($member);
        }

        return redirect()->route('advanced.members.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Member $member
     * @return \App\Http\Resources\Api\MemberResource
     */
    public function show(Request $request, Member $member)
    {
        if ($request->wantsJson()) {
            return new MemberResource($member);
        }

        return view('members.show', compact('member'));
    }

    /**
     * @param \App\Http\Requests\Api\MemberUpdateRequest $request
     * @param \App\Models\Member $member
     * @return \App\Http\Resources\Api\MemberResource
     */
    public function update(MemberUpdateRequest $request, Member $member)
    {
        $member->update($request->validated());

        if ($request->wantsJson()) {
            return new MemberResource($member);
        }

        return redirect()->route('advanced.members.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Member $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Member $member)
    {
        $member->delete();

        if ($request->wantsJson()) {
            return response()->noContent();
        }

        return redirect()->route('advanced.members.index');
    }
}
