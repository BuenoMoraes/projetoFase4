@extends('layout')

@section('cabecalho')
    Adicionar Lívro
@endsection

@section('conteudo')
@include('erros', ['errors' => $errors])

<form method="post">
    @csrf
    <label for="titulo">Título</label>
    <input type="text" class="form-control" name="titulo" id="titulo">

    <div class="row mt-2">
        <div class="col col-6">
            <label for="autor">Autor</label>
            <input type="text" class="form-control" name="autor" id="autor">
        </div>

        <div class="col col-3">
            <label for="anoPublicacao">Ano Publicação</label>
            <input type="text" class="form-control" name="anoPublicacao" id="anoPublicacao">
        </div>

        <div class="col col-3">
            <label for="statusLivro">Status Lívro</label>
            <input type="text" class="form-control" name="statusLivro" id="statusLivro">
        </div>
    </div>

    <button class="btn btn-primary mt-2">Adicionar</button>
</form>
@endsection