<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContratoRequest extends FormRequest
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
            'endereco' => 'required|max:255|min:3',
            'observacoes' => 'max:255',
            'preco' => 'required|numeric',
            'data_inicio' => 'date|required|after:yesterday',
            'data_fim' => 'date|required|after:data_inicio',
        ];
    }

    public function messages()
    {
        return [
            'endereco.required' => 'O campo endereço é obrigatório.',
            'endereco.max' => 'O campo endereço deve conter no máximo 255 caracteres.',
            'endereco.min' => 'O campo endereço deve conter no mínimo 3 caracteres.',
            
            'observacoes.max' => 'O campo observações deve conter no máximo 255 caracteres.',

            'preco.required' => 'O campo preço total é obrigatório.',
            'preco.numeric' => 'O campo preço total deve conter um valor numérico.',

            'data_inicio.after' => 'O campo data inicio deve conter uma data posterior ao dia de ontem.',

            

        ];
    }
}
