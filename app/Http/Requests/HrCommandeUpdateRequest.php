<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HrCommandeUpdateRequest extends FormRequest
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
            'order_id' => ['required', 'integer', 'exists:orders,id'],
            'is_paid_at' => ['string'],
            'total_command' => ['required', 'numeric'],
            'softdeletes' => ['required'],
        ];
    }
}
