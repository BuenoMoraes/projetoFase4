@extends('layout')

@section('cabecalho')
Usuários
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

@auth
<a href="/registrar" class="btn btn-dark mb-2">Adicionar Usuário</a>
@endauth

<ul class="list-group">
    @foreach($usuarios as $usuario)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <span id="name-usuario-{{ $usuario->id }}">Nome: {{$usuario->name}} <br> Email: {{$usuario->email}}</span>
        <span id="email-usuario-{{ $usuario->id }}"></span>
        
        
        <div class="input-group w-50" hidden id="input-name-usuario-{{ $usuario->id }}">
            <input type="text" class="form-control" value="{{ $usuario->name }}">
            <div class="input-group-append">
                <button class="btn btn-primary" onclick="editarUsuario({{ $usuario->id }})">
                       <i class="fas fa-check"></i>
                </button>
                @csrf
            </div>
        </div>


        <span class="d-flex">
            @auth
            <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{ $usuario->id }})">
                <i class="fas fa-edit"></i>
            </button>
            @endauth
            @auth
            <form method="post" action="/registro/{{ $usuario->id }}"
                  onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($usuario->name) }}?')">
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
    function toggleInput(usuarioId) {
        const nomeUsuarioEl = document.getElementById(`name-usuario-${usuarioId}`);
        //const emailUsuarioEl = document.getElementById(`email-usuario-${usuarioId}`);
        const inputUsuariosEl = document.getElementById(`input-name-usuario-${usuarioId}`);
        //const inputEmailUsuariosEl = document.getElementById(`input-email-usuario-${usuarioId}`);
        if (nomeUsuarioEl.hasAttribute('hidden')) {
            nomeUsuarioEl.removeAttribute('hidden');
            //emailUsuarioEl.removeAttribute('hidden');
            inputUsuariosEl.hidden = true;
            //inputEmailUsuariosEl.hidden = true;
        } else {
            inputUsuariosEl.removeAttribute('hidden');
           // inputEmailUsuariosEl.removeAttribute('hidden');
            nomeUsuarioEl.hidden = true;
            //emailUsuarioEl.hiden = true;
        }
    }

    function editarUsuario(usuarioId) {
        let formData = new FormData();
        const name = document
            .querySelector(`#input-name-usuario-${usuarioId} > input`)
            .value;
        /*const email = document
            .querySelector(`#input-email-usuario-${usuarioId} > input2`)
            .value;*/
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        /*const token2 = document
            .querySelector(`input[name="_token2"]`)
            .value;*/
        formData.append('name', name);
        //formData.append('email', email);
        formData.append('_token', token);
        //formData.append('_token2', token2);
        const url = `/registro/${usuarioId}/editaNome`;
        fetch(url, {
                method: 'POST',
                body: formData
        }).then(() => {
            toggleInput(usuarioId);
            document.getElementById(`name-usuario-${usuarioId}`).textContent = name;
            //document.getElementById(`email-usuario-${usuarioId}`).textContent = email;
        });
    }
</script>
@endsection