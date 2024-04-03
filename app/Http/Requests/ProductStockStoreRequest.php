<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStockStoreRequest extends FormRequest
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
            'name' => ['string', 'max:250'],
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'stock_id' => ['required', 'integer', 'exists:stocks,id'],
            'quantity' => ['required', 'numeric'],
            'prix_revient' => ['required', 'numeric'],
            'prix_vente' => ['required', 'numeric'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'created_at' => ['required'],
            'updated_at' => ['required'],
        ];
    }
}
