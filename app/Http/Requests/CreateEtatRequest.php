<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateEtatRequest extends Request
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
            'designation'=>'required',
            'img'=>'required'
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
            'designation.required' => 'Nom du verdict obligatoire',
            'img.required'=>'Image du verdict obligatoire',
        ];
    }
}
