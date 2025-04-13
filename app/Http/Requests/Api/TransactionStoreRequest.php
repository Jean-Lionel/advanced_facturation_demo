<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class TransactionStoreRequest extends FormRequest
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

            'member_id' => ['required', 'integer', 'exists:members,id'],
            'transaction_type_id' => ['required', 'integer', 'exists:transaction_types,id'],
            'montant' => ['required', 'numeric'],
            'description' => ['nullable'],
            'date_transaction' => ['required', 'date'],
        ];
    }
}
