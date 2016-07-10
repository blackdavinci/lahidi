<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateEngagementRequest extends Request
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
            'intitule'=>'required',
            'categorie_id'=>'required',
            'secteur_id'=>'required',
        ];
    }

     /**
     * Get the validation rules errors messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'intitule.required' => 'Promesse obligatoire',
            'categorie_id.required' => 'Catégorie obligatoire',
            'secteur_id.required' => 'Secteur obligatoire',
        ];
    }
}
