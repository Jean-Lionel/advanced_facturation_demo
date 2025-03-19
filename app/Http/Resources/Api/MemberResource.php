<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'title' => $this->title,
            'profile_image' => $this->profile_image,
            'phone' => $this->phone,
            'address' => $this->address,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'organisation_id' => $this->organisation_id,
            'user_id' => $this->user_id,
            'organisations' => OrganisationCollection::make($this->whenLoaded('organisations')),
        ];
    }
}
