<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createClientRequest extends FormRequest
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
            'adresse_email_client' => 'nullable|regex:/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}/',
            'nom_client' => 'required|max:50',
            'prenom_client' => 'required|max:50',
            'site_client' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'codepostal_client' => 'nullable|regex:/[0-9]/',
            'tel_client' => 'nullable|unique:clients|regex:/[+][0-9]/'
        ];
    }
}
