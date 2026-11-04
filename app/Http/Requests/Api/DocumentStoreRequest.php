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
            'document_type' => ['string', 'nullable'],
            'name' => ['required_without:files', 'nullable', 'string', 'max:255'],
            'description' => ['string', 'nullable'],
            'member_id' => ['nullable', 'integer', 'exists:members,id'],
            'client_id' => ['nullable', 'integer', 'exists:clients,id'],
            'file' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx,csv,txt,jpg,jpeg,png,gif,webp'],
            'files' => ['nullable', 'array'],
            'files.*' => ['file', 'mimes:pdf,doc,docx,xls,xlsx,csv,txt,jpg,jpeg,png,gif,webp'],
            'names' => ['nullable', 'array'],
            'names.*' => ['required', 'string', 'max:255'],
        ];
    }
}
