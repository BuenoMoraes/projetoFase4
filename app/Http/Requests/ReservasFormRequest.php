<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'usuario_id' => ['required' ,Rule::exists('users','id')],
            'livro_id' => ['required' ,Rule::exists('livros','id')],
            'inicio' => 'required|min:10|max:10',
            'termino' => 'required|min:10|max:10'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'usuario_id.required' => 'O campo Nome Usuário é obrigatório',
            'livro_id.required' => 'O campo Título Livro é obrigatório',
            'inicio.min' => 'O campo inicio precisa ter no mínimo 10 caracteres, siga o exemplo', 
            'inicio.max' => 'O campo inicio precisa ter no máximo 10 caracteres, siga o exemplo',
            'termino.min' => 'O campo termino precisa ter no mínimo 10 caracteres, siga o exemplo', 
            'termino.max' => 'O campo termino precisa ter no máximo 10 caracteres, siga o exemplo',
            'usuario_id.exists' => 'O usuario_id informado não possui nenhum usuário cadastrado no sistema',
            'livro_id.exists' => 'O livro_id informado não possui nenhum lívro cadastrado no sistema'
        ];
    }
}
