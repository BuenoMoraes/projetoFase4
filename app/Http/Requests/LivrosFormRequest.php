<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'autor_id' => ['required', Rule::exists('autors','id')],
            'status_id' => ['required', Rule::exists('statuses','id')]

        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'anoPublicacao.min' => 'O campo ano publicação precisa ter pelo menos 4 caracteres',
            'autor_id.required' => 'O campo autor é obrigatório',
            'status_id.required' => 'O campo status é obrigatório',
            'autor_id.exists' => 'O autor_id informado não possui nenhum autor cadastrado no sistema',
            'status_id.exists' => 'O status_id informado não possui nenhum status cadastrado no sistema'
        ];
    }

    public function attributes()
    {
        return [
            'autor_id' => 'Autor'
        ];
    }

    
}
