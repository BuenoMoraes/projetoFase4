<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\RemovedorDeUsuario;
use App\Http\Requests\RegistrosFormRequest;


class RegistroController extends Controller
{
    public function index(Request $request) {
        $usuarios = User::query()
            ->orderBy('name')
            ->get();
        $mensagem = $request->session()->get('mensagem');

        return view('registro.index', compact('usuarios', 'mensagem'));
    }

    public function create()
    {
        return view('registro.create');
    }

    public function store(RegistrosFormRequest $request)
    {
        $data = $request->except('_token');
        /*Criptografia*/ 
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        $request->session()
        ->flash(
            'mensagem',
            "Usuário com id {$user->id} e nome {$user->name} criado com sucesso "
        );
        
        Auth::login($user);

       

        return redirect()->route('listar_usuarios');
    }

    public function destroy(Request $request, RemovedorDeUsuario $removedorDeUsuario)
    {
        $nomeUsuario = $removedorDeUsuario->removerUsuario($request->id);
        $request->session()
            ->flash(
                'mensagem',
                "Usuário $nomeUsuario removido com sucesso"
            );

        return redirect()->route('listar_usuarios');
    }

    public function editaNome(int $id, Request $request)
    {
        $usuario = User::find($id);
        $novoNome = $request->name;
        $novoEmail = $request->email;
        if(strlen($novoNome)> 2){
            $usuario->name = $novoNome;
        }else{
            $request->session()
            ->flash(
                'mensagem',
                "Tente novamente com um nome válido, ou seja,  com mais de 2 caracteres"
            );
        }
        $usuario->save();
    }
}
