<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommissionDetailUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'compte_id' => ['integer', 'exists:comptes,id'],
            'client_id' => ['integer', 'exists:clients,id'],
            'order_id' => ['integer', 'exists:orders,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'montant' => ['required', 'numeric'],
            'activite' => ['string'],
            'description' => ['string'],
            'softdeletes' => ['required'],
        ];
    }
}
