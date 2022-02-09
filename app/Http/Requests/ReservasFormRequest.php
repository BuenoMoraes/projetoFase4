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
            'usuario_id' => 'required',
            'livro_id' => 'required',
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
            'termino.max' => 'O campo termino precisa ter no máximo 10 caracteres, siga o exemplo'
        ];
    }
}
