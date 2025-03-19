<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'transaction_type_id' => $this->transaction_type_id,
            'montant' => $this->montant,
            'description' => $this->description,
            'date_transaction' => $this->date_transaction,
            'transactionFiles' => TransactionFileCollection::make($this->whenLoaded('transactionFiles')),
        ];
    }
}
