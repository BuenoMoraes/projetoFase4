<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservasFormRequest extends FormRequest
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
            'nomeUsuario' => 'required|min:3',
            'nomeLivro' => 'required|min:2',
            'inicio' => 'required|min:10, max:10',
            'termino' => 'required|min:10, max:10'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'nomeUsuario.min' => 'O campo nome Usuario precisa ter pelo menos 3 caracteres',
            'nomeLivro.min' => 'O campo nome Livro precisa ter pelo menos 2 caracteres',
            'inicio.min' => 'O campo inicio precisa ter no mínimo 10 caracteres, siga o exemplo', 
            'inicio.max' => 'O campo inicio precisa ter no máximo 10 caracteres, siga o exemplo',
            'termino.min' => 'O campo termino precisa ter no mínimo 10 caracteres, siga o exemplo', 
            'termino.max' => 'O campo termino precisa ter no máximo 10 caracteres, siga o exemplo'
        ];
    }
}
