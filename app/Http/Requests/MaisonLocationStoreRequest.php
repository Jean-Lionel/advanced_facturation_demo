<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaisonLocationStoreRequest extends FormRequest
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
            
            'name' => ['required', 'string', 'unique:maison_locations'],
            'description' => ['string', 'nullable'],
            'montant' => ['required', 'numeric'],
            'tax' => ['required'],
           
        ];
    }
}
