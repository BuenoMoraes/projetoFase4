@extends('layout')

@section('cabecalho')
    Registrar-se
@endsection

@section('conteudo')
@include('erros', ['errors' => $errors])

<form method="post">
    @csrf
    <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" name="name" id="name"  class="form-control" maxlength="255">
    </div>

    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email"  class="form-control" maxlength="255">
    </div>

    <div class="form-group">
        <label for="password">Senha</label>
        <input type="password" name="password" id="password" class="form-control" maxlength="255">
    </div>

    <button type="submit" class="btn btn-primary mt-3">
        Entrar
    </button>
</form>
@endsection