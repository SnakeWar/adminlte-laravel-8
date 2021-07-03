<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkwithusRequest extends FormRequest
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
            'name'         => 'required',
            //'telephone'         => 'required',
            'message'         => 'required',
            'email'         => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ];
    }
    public function messages()
    {
        return [
            'required'  => 'Este campo é obrigatório.',
//            'min'         => 'Campo deve ter no mínimo :min caracteres.',
            'unique' => 'Título já cadastrado anteriormente.'
        ];
    }
}