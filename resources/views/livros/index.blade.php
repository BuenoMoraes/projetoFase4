@extends('layout')

@section('cabecalho')
Livros
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

@auth
<a href="{{ route('form_criar_livro') }}" class="btn btn-dark mb-2">Adicionar Livro</a>
@endauth

<ul class="list-group">
    @foreach($livros as $livro)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <span id="status-livro-{{ $livro->id }}">Título: {{ $livro->titulo }} </br> Autor: {{ $livro->autor }}</br>Ano Publicação: {{ $livro->anoPublicacao }}</br>Status Livro: {{ $livro->statusLivro }}</span>
        
        <div class="input-group w-50" hidden id="input-titulo-livro-{{ $livro->id }}">
            <input type="text" class="form-control" value="{{ $livro->statusLivro }}">
            <div class="input-group-append">
                <button class="btn btn-primary"  onclick="editarLivro({{ $livro->id }})">
                    <i class="fas fa-check"></i>
                </button>
                @csrf
            </div>
        </div>
        <span class="d-flex">
            @auth
            <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{ $livro->id }})">
                <i class="fas fa-edit"></i>
            </button>
            @endauth
            @auth
            <form method="post" action="/livros/{{ $livro->id }}"
                  onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($livro->titulo) }}?')">
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
    function toggleInput(livroId) {
        const tituloLivroEl = document.getElementById(`status-livro-${livroId}`);
        const inputLivroEl = document.getElementById(`input-titulo-livro-${livroId}`);
        if (tituloLivroEl.hasAttribute('hidden')) {
            tituloLivroEl.removeAttribute('hidden');
            inputLivroEl.hidden = true;
        } else {
            inputLivroEl.removeAttribute('hidden');
            tituloLivroEl.hidden = true;
        }
    }

    function editarLivro(livroId) {
        let formData = new FormData();
        const statusLivro = document
            .querySelector(`#input-titulo-livro-${livroId} > input`)
            .value;
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        formData.append('statusLivro', statusLivro);
        formData.append('_token', token);
        const url = `/livros/${livroId}/editaLivro`;
        fetch(url, {
                method: 'POST',
                body: formData
        }).then(() => {
            toggleInput(livroId);
            document.getElementById(`status-livro-${livroId}`).textContent = statusLivro;
        });
    }
</script>
@endsection