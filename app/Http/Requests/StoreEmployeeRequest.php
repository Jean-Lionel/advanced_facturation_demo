<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "first_name" => "required",
            "last_name" => "required",
            "date_of_birth" => "required|date",
            "joining_date" => "required|date",
            "cni_number" => "required",
            "fonction_id" => "required",
            "basic_salary" => "required",
            "gender" => "required",
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "first_name.required" => "Le Prénom de l'employée est requis",
            "last_name.required" => "Le Nom de l'employée est requis",
            "date_of_birth.required" => "La Date de naissance de l'employée est requis",
            "joining_date.required" => "Le Date de Recrutement de l'employée est requis",
            "cni_number.required" => "Le Numero d'identité de l'employée est requis",
            "fonction_id.required" => "Le Poste de l'employée est requis",
            "basic_salary.required" => "Le Salaire de base de l'employée est requis",
            "gender.required" => "Le Sexe de l'employée est requis",
        ];
    }
}
