<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\RemovedorDeUsuario;

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

    public function store(Request $request)
    {
        $data = $request->except('_token');
        /*Criptografia*/ 
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

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
}
