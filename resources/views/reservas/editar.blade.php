@extends('layout')

@section('cabecalho')
    Atualizar Reserva
@endsection

@section('conteudo')
@include('erros', ['errors' => $errors])

<form method="post">
    @csrf
    <div class="form-group" id="input-nomeUsuario-reserva-{{ $reserva->id }}">
        <label for="name">Nome</label>
        <input type="text" name="nomeUsuario" id="nomeUsuario"  class="form-control" maxlength="255" value = "{{ $reserva->nomeUsuario}}">
    </div>


    <div class="form-group" id="input-nomeLivro-reserva-{{ $reserva->id }}">
        <label for="nomeLivro">Nome Livro</label>
        <input type="text" class="form-control" name="nomeLivro" id="nomeLivro" maxlength="255" value = "{{ $reserva->nomeLivro}}">
    </div>

    <div class="row mt-2">
        <div class="col col-6" id="input-inicio-reserva-{{ $reserva->id }}">
            <label for="inicio">Inicio</label>
            <input type="text" class="form-control" name="inicio" id="inicio" placeholder="DD/MM/AAAA" maxlength="255" value = "{{ $reserva->inicio}}">
        </div>

        <div class="col col-6" id="input-termino-reserva-{{ $reserva->id }}">
            <label for="termino">Término</label>
            <input type="text" class="form-control" name="termino" id="termino" placeholder="DD/MM/AAAA" maxlength="255" value = "{{ $reserva->termino}}">
        </div>
    </div>

    <button onclick="editarUsuario({{ $reserva->id }})" type="submit" class="btn btn-primary mt-3">
        Atualizar
    </button>
</form>

<script>
   function editarReserva(reservaId) {
        let formData = new FormData();
        const name = document
            .querySelector(`#input-nome-usuario-${usuarioId} > input`)
            .value;
        const email = document
            .querySelector(`#input-email-usuario-${usuarioId} > input`)
            .value;
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        formData.append('name', name);
        formData.append('email', email);
        formData.append('_token', token);
        const url =`/registro/${usuarioId}/editaUsuario`;
        fetch(url, {
                method: 'POST',
                body: formData
        }).then(() => {
            document.getElementById(`status-livro-${livroId}`).textContent = nome;
        });
    }
</script>

@endsection