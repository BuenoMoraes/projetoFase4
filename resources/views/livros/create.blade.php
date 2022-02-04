@extends('layout')

@section('cabecalho')
    Adicionar Lívro
@endsection

@section('conteudo')
@include('erros', ['errors' => $errors])
<!--{{var_dump($autor)}}-->


<form method="post">
    @csrf
    <label for="titulo">Título</label>
    <input type="text" class="form-control" name="titulo" id="titulo" maxlength="255">

    <div class="row mt-2">
        <div class="col col-6">
            <label for="autor">Autor</label>
            <select class="form-control" name="autor_id" id="autor_id">
                <option value=""></option>
                @foreach ($autor as $autor)
                <option value="{{$autor->id}}">{{$autor->autor}}</option>
                @endforeach
            </select>
            <!-- <input type="text" class="form-control" name="autor" id="autor" maxlength="255"> -->
        </div>

        <div class="col col-3">
            <label for="anoPublicacao">Ano Publicação</label>
            <input type="text" class="form-control" name="anoPublicacao" id="anoPublicacao" maxlength="255">
        </div>

        <div class="col col-3">
            <label for="status_id">Status Lívro</label>
            <select class="form-control" name="status_id" id="status_id">
                <option value=""></option>
                @foreach ($status as $status)
                <option value="{{$status->id}}">{{$status->status}}</option>
                @endforeach
            </select>
            <!-- <input type="text" class="form-control" name="statusLivro" id="statusLivro" maxlength="255"> -->
        </div>
    </div>

    <button class="btn btn-primary mt-2">Adicionar</button>
</form>

@endsection