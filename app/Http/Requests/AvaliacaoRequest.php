<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvaliacaoRequest extends FormRequest
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
            'avaliacao_nota' => 'required|numeric',
            'avaliacao_cmt' => 'max:255',
        ];
    }

    public function messages()
    {
        return [
            
            'avaliacao_nota.required' => 'O campo nota é obrigatório.',
            'avaliacao_nota.numeric' => 'O campo nota deve conter um valor numérico.',
            'avaliacao_cmt.max' => 'O campo comentário deve conter no máximo 255 caracteres.',

        ];
    }
}
