<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NecessidadeRequest extends FormRequest
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
            'titulo' => 'required|max:100|min:3',//
            'categoria_id' => 'required|numeric',//
            'descricao' => 'required|max:255|min:3', //
            'observacoes' => 'max:255', //
            'estado_id' => 'required|numeric',//
            'cidade_id' => 'required|numeric',//
            'telefone' => 'nullable',
            'celular' => 'nullable',
            'email' => 'email|required|max:100',
            'data_limite' => 'date|required|after:yesterday',//
        ];
    }



    public function messages()
    {
        return [

            'titulo.required' => 'O campo título é obrigatório.',
            'titulo.max' => 'O campo título deve conter no máximo 100 caracteres.',
            'titulo.min' => 'O campo título deve conter no mínimo 3 caracteres.',


            'categoria_id.required' => 'O campo categoria é obrigatório.',

            'descricao.required' => 'O campo descrição é obrigatório.',
            'descricao.max' => 'O campo descrição deve conter no máximo 255 caracteres.',
            'descricao.min' => 'O campo descrição deve conter no mínimo 3 caracteres.',

            'observacoes.max' => 'O campo observações deve conter no máximo 255 caracteres.',

            'estado_id.required' => 'O campo estado é obrigatório.',
            'cidade_id.required' => 'O campo cidade é obrigatório.',

            'email.email' => 'O campo e-mail deve conter um e-mail válido.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.max' => 'O campo e-mail deve conter no máximo 100 caracteres.',

            
            'data_limite.after' => 'O campo data limite deve conter uma data posterior ao dia de ontem.',
            'data_limite.required' => 'O campo data limite é obrigatório.',
            'data_limite.date' => 'O campo data limite deve conter uma data válida.',
        ];
    }
}
