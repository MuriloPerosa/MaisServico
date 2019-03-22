<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InteresseRequest extends FormRequest
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
            'orcamento' => 'required|max:255|min:3',
            'oferta_id' => 'required|numeric',
            'telefone' => 'nullable',
            'celular' => 'nullable',
            'email' => 'email|required|max:100',
        ];


    }

    public function messages()
    {
        return [
            'orcamento.required' => 'O campo orçamento é obrigatório.',
            'orcamento.max' => 'O campo orçamento deve conter no máximo 255 caracteres.',
            'orcamento.min' => 'O campo orçamento deve conter no mínimo 3 caracteres.',

            'email.email' => 'O campo e-mail deve conter um e-mail válido.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.max' => 'O campo e-mail deve conter no máximo 100 caracteres.',

            'oferta_id.required' => 'Você deve selecionar uma oferta.',
        ];
    }
}
