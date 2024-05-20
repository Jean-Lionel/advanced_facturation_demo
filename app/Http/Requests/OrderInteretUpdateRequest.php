<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderInteretUpdateRequest extends FormRequest
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
            'order_id' => ['integer', 'exists:orders,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'montant' => ['required', 'numeric'],
            'description' => ['string'],
            'softdeletes' => ['required'],
        ];
    }
}
