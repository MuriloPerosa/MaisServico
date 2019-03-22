<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PessoaRequest extends FormRequest
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
            'rg' => 'required|min:9|max:25',
            'cpf' => 'required|min:11',
            'data_nascimento' => 'required|date',
            'cidade_id' => 'required',
            'estado_id' => 'required',
            'telefone' => 'nullable',
            'celular' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            
            'estado_id.required' => 'O campo estado é obrigatório.',
            'estado_id.numeric' => 'O campo estado deve conter um valor numérico.',
            'cidade_id.required' => 'O campo cidade é obrigatório.',
            'cidade_id.numeric' => 'O campo cidade deve conter um valor numérico.',

            'data_nascimento.required' => 'O campo data de nascimento é obrigatório.',
            'data_nascimento.date' => 'O campo data de nascimento deve conter uma data válida.',
        ];
    }
}
