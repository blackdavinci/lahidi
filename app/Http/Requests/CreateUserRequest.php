<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateUserRequest extends Request
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'role' => 'required',
            'password' => 'required|min:6|confirmed',     
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
            'name.required' => 'Nom obligatoire',
            'email.required'=>'E-mail obligatoire',
            'email.unique' => 'Compte déjà existant avec cette adresse',
            'role.required' => 'Rôle obligatoire',
            'passwor.required' => 'Mot de passe obligatoire',
            'password.min' => '6 caratères minimum',
            'password.confirmed' => 'Confirmez le mot de passe'
        ];
    }
}
