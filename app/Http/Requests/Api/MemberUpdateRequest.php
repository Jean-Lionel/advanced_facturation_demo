<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

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
            'email' => ['required', 'email', 'max:100', 'unique:members,email'],
            'title' => ['required', 'string', 'max:50'],
            'profile_image' => ['string', 'max:255'],
            'phone' => ['string', 'max:30'],
            'address' => ['string'],
            'description' => ['string'],
            'is_active' => ['required'],
            'organisation_id' => ['integer', 'exists:organisations,id'],
            'user_id' => ['integer', 'exists:users,id'],
        ];
    }
}
