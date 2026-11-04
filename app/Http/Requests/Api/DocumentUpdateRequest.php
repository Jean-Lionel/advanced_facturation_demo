<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class DocumentUpdateRequest extends FormRequest
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
            'member_id' => ['nullable', 'integer', 'exists:members,id'],
            'client_id' => ['nullable', 'integer', 'exists:clients,id'],
            'document_type' => ['nullable', 'string'],
            'transaction_file_id' => ['nullable', 'integer', 'exists:transaction_files,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'file' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx,csv,txt,jpg,jpeg,png,gif,webp'],
        ];
    }
}
