<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmbalageStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string'],
            'price' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
            'type_embalage_id' => ['required', 'integer', 'exists:type_embalages,id'],
        ];
    }
}
