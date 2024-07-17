<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HrFicheDetailUpdateRequest extends FormRequest
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
            'fiche_id' => ['required', 'integer', 'exists:fiches,id'],
            'commande_id' => ['required', 'integer', 'exists:commandes,id'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['date'],
            'description' => ['string'],
            'softdeletes' => ['required'],
        ];
    }
}
