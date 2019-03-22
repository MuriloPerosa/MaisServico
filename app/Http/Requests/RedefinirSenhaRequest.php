<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RedefinirSenhaRequest extends FormRequest
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
            'email' => 'required|email|max:100',
        ];
    }

    public function messages()
    {
        return [
            'email.email' => 'O campo e-mail deve conter um e-mail válido.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.max' => 'O campo e-mail deve conter no máximo 100 caracteres.',
        ];
    }
}
