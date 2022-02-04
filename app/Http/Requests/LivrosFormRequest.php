<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LivrosFormRequest extends FormRequest
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
            'titulo' => 'required|min:2',
            'anoPublicacao' => 'required|min:4',
            //'autor' => 'required',
           // 'statusLivro' => 'required'

        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'anoPublicacao.min' => 'O campo ano publicação precisa ter pelo menos 4 caracteres',
        ];
    }
}
