<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\NotificationStoreRequest;
use App\Http\Requests\Api\NotificationUpdateRequest;
use App\Http\Resources\Api\NotificationCollection;
use App\Http\Resources\Api\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Api\NotificationCollection
     */
    public function index(Request $request)
    {
        $notifications = Notification::all();

        return new NotificationCollection($notifications);
    }

    /**
     * @param \App\Http\Requests\Api\NotificationStoreRequest $request
     * @return \App\Http\Resources\Api\NotificationResource
     */
    public function store(NotificationStoreRequest $request)
    {
        $notification = Notification::create($request->validated());

        return new NotificationResource($notification);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Notification $notification
     * @return \App\Http\Resources\Api\NotificationResource
     */
    public function show(Request $request, Notification $notification)
    {
        return new NotificationResource($notification);
    }

    /**
     * @param \App\Http\Requests\Api\NotificationUpdateRequest $request
     * @param \App\Models\Notification $notification
     * @return \App\Http\Resources\Api\NotificationResource
     */
    public function update(NotificationUpdateRequest $request, Notification $notification)
    {
        $notification->update($request->validated());

        return new NotificationResource($notification);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Notification $notification)
    {
        $notification->delete();

        return response()->noContent();
    }
}
