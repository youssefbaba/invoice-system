<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class factureRequest extends FormRequest
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
            'quantité' => 'required',
            'prixht' => 'required',
            'motcle' => 'required|max:250',
            'text_intro' => 'required|max:250',
            'text_concl' => 'required|max:250',
            'text_pied' => 'required|max:250',
            'compte_bancaire' => 'required'
        ];
    }
}
