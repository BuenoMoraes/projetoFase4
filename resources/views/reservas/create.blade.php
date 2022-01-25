@extends('layout')

@section('cabecalho')
    Adicionar Reserva
@endsection

@section('conteudo')
@include('erros', ['errors' => $errors])

<form method="post">
    @csrf
    <label for="nomeUsuario">Nome Usuário</label>
    <input type="text" class="form-control" name="nomeUsuario" id="nomeUsuario" maxlength="255">

    <label for="nomeLivro">Nome Livro</label>
    <input type="text" class="form-control" name="nomeLivro" id="nomeLivro" maxlength="255">

    <div class="row mt-2">
        <div class="col col-6">
            <label for="inicio">Inicio</label>
            <input type="text" class="form-control" name="inicio" id="inicio" placeholder="DD/MM/AAAA" maxlength="255">
        </div>

        <div class="col col-6">
            <label for="termino">Término</label>
            <input type="text" class="form-control" name="termino" id="termino" placeholder="DD/MM/AAAA" maxlength="255">
        </div>
    </div>

    <button class="btn btn-primary mt-2">Adicionar</button>
</form>
@endsection