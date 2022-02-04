@extends('layout')

@section('cabecalho')
Lívros
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

@auth
<a href="{{ route('form_criar_livro') }}" class="btn btn-dark mb-2">Adicionar Lívro</a>
@endauth

<ul class="list-group">
    @foreach($livros as $livro)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <span id="status-livro-{{ $livro->id }}">Título: {{ $livro->titulo }} </br> Autor: {{ $livro->autor_id }}</br>Ano Publicação: {{ $livro->anoPublicacao }}</br>Status Livro: {{ $livro->status_id}}</span>
        <span class="d-flex">
            @auth
            <a class="btn btn-info btn-sm mr-1" href="/livros/edit/{{ $livro->id }}">
                <i class="fas fa-edit"></i>
            </a>
            @endauth
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