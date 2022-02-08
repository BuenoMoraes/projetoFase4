@extends('layout')

@section('cabecalho')
    Atualizar Lívro
@endsection

@section('conteudo')
@include('erros', ['errors' => $errors])

<form method="post">
    @csrf
    <div class="form-group" id="input-titulo-livro-{{ $livro->id }}">
        <label for="titulo">Título</label>
        <input type="text" class="form-control" name="titulo" id="titulo" maxlength="255" value="{{ $livro->titulo }}">
    </div>
    <div class="row mt-2" >
        <div class="col col-6" id="input-autor-livro-{{ $livro->id }}">
            <label for="autor">Autor</label>
            <select class="form-control" name="autor_id" id="autor_id" >
                <option value="{{$livro->autor_id}}">{{$autor->where('id', $livro->autor_id)->pluck('autor')->first()}}</option>
                    <?php
                    foreach ($autor as $autor)
                        if($autor->id != $livro->autor_id){
                            ?><option value="{{$autor->id}}">{{$autor->autor}}</option><?php
                        }
                    ?>
            </select>
        </div>

        <div class="col col-3" id="input-anoPublicacao-livro-{{ $livro->id }}">
            <label for="anoPublicacao">Ano Publicação</label>
            <input type="text" class="form-control" name="anoPublicacao" id="anoPublicacao" maxlength="255" value="{{ $livro->anoPublicacao }}">
        </div>

        <div class="col col-3" id="input-status-livro-{{ $livro->id }}">
            <label for="statusLivro">Status Lívro</label>
            <select class="form-control" name="status_id" id="status_id">
                <option  value="{{$livro->autor_id}}">{{$status->where('id', $livro->status_id)->pluck('status')->first()}}</option>
                <?php
                    foreach ($status as $status)
                        if($status->id != $livro->status_id){
                            ?><option value="{{$status->id}}">{{$status->status}}</option><?php
                        }
                    ?>
            </select>
        </div>
    </div>

    <button onclick="editarLivro({{ $livro->id }})" type="submit" class="btn btn-primary mt-3">
        Atualizar
    </button>
</form>

<script>
   function editarLivro(livroId) {
        let formData = new FormData();
        const titulo = document
            .querySelector(`#input-titulo-livro-${livroId} > input`)
            .value;
        const autor = document
            .querySelector(`#input-autor-livro-${livroId} > input`)
            .value;
        const anoPublicacao = document
            .querySelector(`#input-anoPublicacao-livro-${livroId} > input`)
            .value;
        const statusLivro = document
            .querySelector(`#input-status-livro-${livroId} > input`)
            .value;
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        formData.append('titulo', titulo);
        formData.append('autor_id', autor_id);
        formData.append('anoPublicacao', anoPublicacao);
        formData.append('status_id', status_id);
        formData.append('_token', token);
        const url =`/registro/${livroId}/editaLivro`;
        fetch(url, {
                method: 'POST',
                body: formData
        });
    }
</script>

@endsection