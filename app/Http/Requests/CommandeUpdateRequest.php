<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommandeUpdateRequest extends FormRequest
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
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'stock_id' => ['integer', 'exists:stocks,id'],
            'client_id' => ['integer', 'exists:clients,id'],
            'type_commande' => ['string'],
            'stock_demandant' => [''],
            'stock_livrant' => [''],
            'description' => ['string'],
        ];
    }
}
