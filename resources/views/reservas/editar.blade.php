@extends('layout')

@section('cabecalho')
    Atualizar Reserva
@endsection

@section('conteudo')
@include('erros', ['errors' => $errors])

<form method="post">
    @csrf
    <div class="form-group" id="input-nomeUsuario-reserva-{{ $reserva->id }}">
        <label for="usuario_id">Nome</label>
        <select class="form-control" name="usuario_id" id="usuario_id">
            <option value=""></option>
            @foreach ($usuario as $usuario)
            <option value="{{$usuario->id}}">{{$usuario->name}}</option>
            @endforeach
        </select>
    </div>


    <div class="form-group" id="input-nomeLivro-reserva-{{ $reserva->id }}">
        <label for="livro_id">Nome Livro</label>
        <select class="form-control" name="livro_id" id="livro_id">
            <option value=""></option>
            @foreach ($livro as $livro)
            <option value="{{$livro->id}}">{{$livro->titulo}}</option>
            @endforeach
        </select>
    </div>

    <div class="row mt-2">
        <div class="col col-6" id="input-inicio-reserva-{{ $reserva->id }}">
            <label for="inicio">Inicio</label>
            <input type="date" class="form-control" name="inicio" id="inicio" placeholder="DD/MM/AAAA" maxlength="255" value = "{{ $reserva->inicio}}">
        </div>

        <div class="col col-6" id="input-termino-reserva-{{ $reserva->id }}">
            <label for="termino">Término</label>
            <input type="date" class="form-control" name="termino" id="termino" placeholder="DD/MM/AAAA" maxlength="255" value = "{{ $reserva->termino}}">
        </div>
    </div>

    <button onclick="editarReserva({{ $reserva->id }})" type="submit" class="btn btn-primary mt-3">
        Atualizar
    </button>
</form>

<script>
   function editarReserva(reservaId) {
        let formData = new FormData();
        const nomeUsuario = document
            .querySelector(`#input-nomeUsuario-reserva-${reservaId} > input`)
            .value;
        const nomeLivro = document
            .querySelector(`#input-nomeLivro-reserva-${reservaId} > input`)
            .value;
        const inicio = document
            .querySelector(`#input-inicio-reserva-${reservaId} > input`)
            .value;
        const termino = document
            .querySelector(`#input-termino-reserva-${reservaId} > input`)
            .value;
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        formData.append('usuario_id', usuario_id);
        formData.append('livro_id', livro_id);
        formData.append('inicio', inicio);
        formData.append('termino', termino);
        formData.append('_token', token);
        const url =`/registro/${reservaId}/editaReserva`;
        fetch(url, {
                method: 'POST',
                body: formData
        });
    }
</script>

@endsection