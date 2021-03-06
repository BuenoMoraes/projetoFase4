@extends('layout')

@section('cabecalho')
Usuários
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])
@include('erros', ['errors' => $errors])

@auth
<a href="/registrar" class="btn btn-dark mb-2">Adicionar Usuário</a>
@endauth

<ul class="list-group">
    @foreach($usuarios as $usuario)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <span id="name-usuario-{{ $usuario->id }}">ID Usuário: {{ $usuario->id }} 
        </br>Nome: {{$usuario->name}} <br> Email: {{$usuario->email}}</span>
        <span id="email-usuario-{{ $usuario->id }}"></span>

        <span class="d-flex">
            @auth
            <a href="/registro/edit/{{ $usuario->id }}" class="btn btn-info btn-sm mr-1">
                <i class="fas fa-edit"></i>
            </a>
            @endauth
            @auth
            <form method="post" action="/registro/{{ $usuario->id }}"
                  onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($usuario->name) }}?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">
                    <i class="far fa-trash-alt"></i>
                </button>
            </form>
            @endauth
        </span>
    </li>
    @endforeach
</ul>
  

@endsection