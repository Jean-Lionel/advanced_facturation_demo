<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmbalageMouvementStoreRequest extends FormRequest
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
            'type' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'numeric'],
            'embalage_id' => ['required', 'integer', 'exists:embalages,id'],
            'client_id' => ['required', 'integer', 'exists:clients,id'],
        ];
    }
}
