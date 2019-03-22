<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'password' => 'min:6|max:255|required',
            'newPassword' => 'min:6|max:255|required',
            'confirmPassword' => 'min:6|max:255|required',
        ];
    }

    public function messages()
    {
        return [

            'password.required' => 'O campo senha é obrigatório.',
            'password.max' => 'O campo senha deve conter no máximo 255 caracteres.',
            'password.min' => 'O campo senha deve conter no mínimo 6 caracteres.',
            
            'newPassword.required' => 'O campo nova senha é obrigatório.',
            'newPassword.max' => 'O campo nova senha deve conter no máximo 255 caracteres.',
            'newPassword.min' => 'O campo nova senha deve conter no mínimo 6 caracteres.', 

            'confirmPassword.required' => 'O campo confirmação senha é obrigatório.',
            'confirmPassword.max' => 'O campo confirmação senha deve conter no máximo 255 caracteres.',
            'confirmPassword.min' => 'O campo confirmação senha deve conter no mínimo 6 caracteres.',
        ];
    }
}
