<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemberUpdateRequest extends FormRequest
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
            'firstname' => ['string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100', Rule::unique('members', 'email')->ignore($this->route('member'))],
            'title' => ['required', 'string', 'max:50'],
            'profile_image' => ['nullable', 'image', 'max:2048'],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable'],
            'organisation_id' => ['nullable', 'integer', 'exists:organisations,id'],
            'user_id' => ['integer', 'exists:users,id'],
        ];
    }
}
