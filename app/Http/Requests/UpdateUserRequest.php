<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        // usando unique, se valida que no se repita email, pero que permita el propio de este usuario y no el de otros
        // capturando el id de usuario enviado por parametro
        return [
            'name' => 'required',
            'avatar' => 'image',
            'email' => 'required|unique:users,email,' . $this->route('user')
        ];
    }
}
