<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockControlStoreRequest extends FormRequest
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
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'old_quantity' => ['required', 'numeric'],
            'new_quantity' => ['required', 'numeric'],
            'sold_quantity' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'description' => ['string'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
