<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class DocumentStoreRequest extends FormRequest
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
            'member_id' => ['integer', 'exists:members,id'],
            'client_id' => ['integer', 'exists:clients,id'],
            'document_type' => ['string'],
            'transaction_file_id' => ['integer', 'exists:transaction_files,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string'],
        ];
    }
}
