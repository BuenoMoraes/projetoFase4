@extends('layout')

@section('cabecalho')
Livros
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

@auth
<a href="{{ route('form_criar_livro') }}" class="btn btn-dark mb-2">Adicionar Livro</a>
@endauth

<ul class="list-group">
    @foreach($livros as $livro)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <span id="titulo-livro-{{ $livro->id }}">{{ $livro->titulo }}</span>
        <div class="input-group w-50" hidden id="input-titulo-livro-{{ $livro->id }}">
            <input type="text" class="form-control" value="{{ $livro->titulo }}">
            <div class="input-group-append">
                <button class="btn btn-primary">
                    <i class="fas fa-check"></i>
                </button>
                @csrf
            </div>
        </div>
        <span class="d-flex">
            @auth
            <button class="btn btn-info btn-sm mr-1">
                <i class="fas fa-edit"></i>
            </button>
            @endauth
            <a href="#" class="btn btn-info btn-sm mr-1">
                <i class="fas fa-external-link-alt"></i>
            </a>
            @auth
            <form method="post" action="/livros/{{ $livro->id }}"
                  onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($livro->titulo) }}?')">
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