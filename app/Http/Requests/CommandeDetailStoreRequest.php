<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommandeDetailStoreRequest extends FormRequest
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
            'commande_id' => ['integer', 'exists:commandes,id'],
            'client_id' => ['integer', 'exists:clients,id'],
            'product_id' => ['integer', 'exists:products,id'],
            'quantite' => ['required', 'numeric'],
            'quantite_livre' => ['required', 'numeric'],
            'price_commande' => ['required', 'numeric'],
            'price_livraison' => ['required', 'numeric'],
            'description' => ['string'],
        ];
    }
}
