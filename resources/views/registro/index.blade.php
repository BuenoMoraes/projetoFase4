@extends('layout')

@section('cabecalho')
Usuários
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

@auth
<a href="/registrar" class="btn btn-dark mb-2">Adicionar Usuário</a>
@endauth

<ul class="list-group">
    @foreach($usuarios as $usuario)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <span id="name-usuario-{{ $usuario->id }}">Nome: {{$usuario->name}}</br>Email: {{$usuario->email}}</span>
        <div class="input-group w-50" hidden id="input-name-usuario-{{ $usuario->id }}">
            <input type="text" class="form-control" value="{{ $usuario->name }}">
            <div class="input-group-append">
                <button class="btn btn-primary">
                    <i class="fas fa-check"></i>
                </button>
                @csrf
            </div>
        </div>
        <span class="d-flex">
            @auth
            <a href="#" class="btn btn-info btn-sm mr-1">
                <i class="fas fa-external-link-alt"></i>
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