@extends('layout')

@section('cabecalho')
    Atualizar Usuário
@endsection

@section('conteudo')
@include('erros', ['errors' => $errors])

<form method="post">
    @csrf
    <div class="form-group" id="input-nome-usuario-{{ $usuario->id }}">
        <label for="name">Nome</label>
        <input type="text" name="name" id="name"  class="form-control" maxlength="255" value = "{{ $usuario->name}}">
    </div>

    <div class="form-group" id="input-email-usuario-{{ $usuario->id }}">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email"  class="form-control" maxlength="255" value = "{{ $usuario->email}}">
    </div>

    <button onclick="editarUsuario({{ $usuario->id }})" type="submit" class="btn btn-primary mt-3">
        Atualizar
    </button>
</form>

<script>
   function editarUsuario(usuarioId) {
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
        });
    }
</script>

@endsection