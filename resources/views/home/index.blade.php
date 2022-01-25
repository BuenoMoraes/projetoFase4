@extends('layout')

@section('cabecalho')
Home
@endsection

@section('conteudo')


@auth
<a href="{{ route('form_criar_livro') }}" class="btn btn-dark mb-2">Home</a>
@endauth

        
@endsection