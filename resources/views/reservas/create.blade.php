@extends('layout')

@section('cabecalho')
    Adicionar Reserva
@endsection

@section('conteudo')
@include('erros', ['errors' => $errors])

<form method="post">
    @csrf
    <label for="usuario_id">Nome Usuário</label>
    <select class="form-control" name="usuario_id" id="usuario_id">
        <option value=""></option>
        @foreach ($usuario as $usuario)
        <option value="{{$usuario->id}}">{{$usuario->name}}</option>
        @endforeach
    </select>

    <label for="livro_id">Título Livro</label>
    <select class="form-control" name="livro_id" id="livro_id">
            <option value=""></option>
            @foreach ($livro as $livro)
            <option value="{{$livro->id}}">{{$livro->titulo}}</option>
            @endforeach
    </select>

    <div class="row mt-2">
        <div class="col col-6">
            <label for="inicio">Inicio</label>
            <input type="date" class="form-control" name="inicio" id="inicio" placeholder="DD/MM/AAAA" maxlength="255">
        </div>

        <div class="col col-6">
            <label for="termino">Término</label>
            <input type="date" class="form-control" name="termino" id="termino" placeholder="DD/MM/AAAA" maxlength="255">
        </div>
    </div>

    <button class="btn btn-primary mt-2">Adicionar</button>
</form>
@endsection