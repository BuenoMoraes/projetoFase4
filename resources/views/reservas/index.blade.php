@extends('layout')

@section('cabecalho')
Reservas
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

@auth
<a href="{{ route('form_criar_reserva') }}" class="btn btn-dark mb-2">Adicionar Reserva</a>
@endauth

<ul class="list-group">
    @foreach($reservas as $reserva)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <span id="nomeUsuario-reserva-{{ $reserva->id }}"> Nome Usuário: {{$reserva->usuario_id }} </br>Título Livro: {{ $reserva->livro_id}}</br>Inicio: {{ $reserva->inicio }}</br>Término: {{ $reserva->termino }} </span>
        <span class="d-flex">
            @auth
            <a href="/reservas/edit/{{ $reserva->id }}" class="btn btn-info btn-sm mr-1">
                <i class="fas fa-edit"></i>
            </a>
            @endauth
            @auth
            <form method="post" action="/reservas/{{ $reserva->id }}"
                  onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($reserva->id) }}?')">
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