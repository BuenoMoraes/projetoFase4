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
        <span id="nomeUsuario-reserva-{{ $reserva->id }}"> Nome Usuário: {{$reserva->nomeUsuario }} </br>Título Livro: {{ $reserva->nomeLivro }}</br>Inicio: {{ $reserva->inicio }}</br>Término: {{ $reserva->termino }} </span>

        <div class="input-group w-50" hidden id="input-nomeUsuario-reserva-{{ $reserva->id }}">
            <input type="text" class="form-control" value="{{ $reserva->nomeUsuario }}">
            <div class="input-group-append">
                <button class="btn btn-primary" onclick="editarUsuario({{ $reserva->id }})">
                    <i class="fas fa-check"></i>
                </button>
                @csrf
            </div>
        </div>

        <span class="d-flex">
            @auth
            <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{ $reserva->id }})">
                <i class="fas fa-edit"></i>
            </button>
            @endauth
            @auth
            <form method="post" action="/reservas/{{ $reserva->id }}"
                  onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($reserva->nomeUsuario) }}?')">
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

<script>
    function toggleInput(reservaId) {
        const nomeUsuarioEl = document.getElementById(`nomeUsuario-reserva-${reservaId}`);
        const inputUsuariosEl = document.getElementById(`input-nomeUsuario-reserva-${reservaId}`);
        if (nomeUsuarioEl.hasAttribute('hidden')) {
            nomeUsuarioEl.removeAttribute('hidden');
            inputUsuariosEl.hidden = true;
        } else {
            inputUsuariosEl.removeAttribute('hidden');
            nomeUsuarioEl.hidden = true;
        }
    }

    function editarUsuario(reservaId) {
        let formData = new FormData();
        const nomeUsuario = document
            .querySelector(`#input-nomeUsuario-reserva-${reservaId} > input`)
            .value;
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        formData.append('nomeUsuario', nomeUsuario);
        formData.append('_token', token);
        const url = `/reservas/${reservaId}/editaNome`;
        fetch(url, {
                method: 'POST',
                body: formData
        }).then(() => {
            toggleInput(reservaId);
            document.getElementById(`nomeUsuario-reserva-${reservaId}`).textContent = nomeUsuario;
        });
    }
</script>
@endsection