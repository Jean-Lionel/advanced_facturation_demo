<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BienvenuHistoriqueUpdateRequest extends FormRequest
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
            'compte_id' => ['required', 'integer', 'exists:comptes,id'],
            'client_id' => ['integer', 'exists:clients,id'],
            'mode_payement' => ['required', 'string', 'max:400'],
            'title' => ['required', 'string', 'max:400'],
            'montant' => ['required', 'numeric'],
            'description' => ['string'],
        ];
    }
}
