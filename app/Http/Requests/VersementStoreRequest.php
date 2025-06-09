<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VersementStoreRequest extends FormRequest
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
            'description' => ['string'],
            'montant' => ['required', 'numeric'],
            'date_transaction' => ['required', 'date'],
            'versement_type_id' => ['required', 'exists:versement_types,id'],
        ];
    }
}
