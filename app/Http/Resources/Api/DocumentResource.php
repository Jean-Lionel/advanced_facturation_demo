<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
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
            'user_id' => $this->user_id,
            'member_id' => $this->member_id,
            'client_id' => $this->client_id,
            'document_type' => $this->document_type,
            'transaction_file_id' => $this->transaction_file_id,
            'name' => $this->name,
            'description' => $this->description,
            'members' => MemberCollection::make($this->whenLoaded('members')),
        ];
    }
}
