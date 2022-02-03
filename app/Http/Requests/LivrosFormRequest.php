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
            'anoPublicacao' => 'required|min:4'
            //'autor' => 'required|min:3',
            //'statusLivro' => 'required|min:7|max:10'

        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            //'titulo.min' => 'O campo titulo precisa ter pelo menos 2 caracteres',
            //'autor.min' => 'O campo autor precisa ter pelo menos 3 caracteres',
            'anoPublicacao.min' => 'O campo ano publicação precisa ter pelo menos 4 caracteres',
            'statusLivro.min' => 'O campo status livro precisa ter pelo menos 7 caracteres',
            'statusLivro.max' => 'O campo status livro precisa ter no máximo 10 caracteres'
        ];
    }
}
