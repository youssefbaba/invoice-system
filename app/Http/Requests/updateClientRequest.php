<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateClientRequest extends FormRequest
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
            'nom_client' => 'required',
            'prenom_client' => 'required',
            'adresse_client' => 'required',
            'tel_client' => 'required|regex:/[+][0-9]/'
        ];
    }
}
