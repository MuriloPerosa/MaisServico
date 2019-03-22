<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            "categoria_id" => "required",
            "cidade_id" => "required",
            "estado_id" => "required",
            "ordenacao" => "required",
            "tipo" => "required",
        ];
    }

    public function messages()
    {
        return [

            'ordenacao.required' => 'O campo ordenação é obrigatório.',

            'categoria_id.required' => 'O campo categoria é obrigatório.',
            'estado_id.required' => 'O campo estado é obrigatório.',
            'cidade_id.required' => 'O campo cidade é obrigatório.',

    
        ];
    }
}
