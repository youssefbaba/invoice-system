<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class devisRequest extends FormRequest
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

            'clients' => 'required|max:50',
            'devis' => 'required',
            'typed' => 'required',
            'descriptiond' => 'required|max:250',
            'remise' => 'required',
            'condition_reglement' => 'required',
            'mode_reglement' => 'required',
            'interet' => 'required',
            'motcled' => 'required|max:50',
            'text_introd' => 'required|max:250',
            'text_cond' => 'required|max:250',
            'text_concld' => 'required|max:250',
            'text_piedd' => 'required|max:250'

        ];
    }
}
