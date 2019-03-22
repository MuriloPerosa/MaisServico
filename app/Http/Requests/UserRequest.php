<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|max:100|min:3',
            'rg' => 'required|min:11|max:25|unique:pessoas',
            'cpf' => 'required|min:11|unique:pessoas|numeric',
            'data_nascimento' => 'required|date|past', //
            'estado_id' => 'required|numeric', // 
            'cidade_id' => 'required|numeric', //
            'telefone' => 'numeric|nullable',
            'celular' => 'numeric|nullable',
        ];
    }

    public function messages()
    {
        return [
            
            'estado_id.required' => 'O campo estado é obrigatório.',
            'estado_id.numeric' => 'O campo estado deve conter um valor numérico.',
            'cidade_id.required' => 'O campo cidade é obrigatório.',
            'cidade_id.numeric' => 'O campo cidade deve conter um valor numérico.',

        ];
    }
}
