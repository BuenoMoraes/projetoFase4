<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivrosFormRequest;
use App\Livro;
use App\Services\CriadorDeLivro;
use App\Services\RemovedorDeLivro;
use App\Temporada;
use Illuminate\Http\Request;
use Exception;


class LivrosController extends Controller
{
    public function index(Request $request) {
        $livros = Livro::query()
            ->orderBy('titulo')
            ->get();
        $mensagem = $request->session()->get('mensagem');

        return view('livros.index', compact('livros', 'mensagem'));
    }

    public function create()
    {
        return view('livros.create');
    }

    public function store(
        LivrosFormRequest $request,
        CriadorDeLivro $criadorDeLivro 
    ) {
        $livro  = $criadorDeLivro->criarLivro([
            'titulo' => $request->titulo,
            'autor' => $request->autor,
            'anoPublicacao' => $request->anoPublicacao,
            'statusLivro' => $request->statusLivro
        ]);
            $request->session()
            ->flash(
                'mensagem',
                "Lívro com id {$livro->id} e título {$livro->titulo} criado com sucesso "
            );

        return redirect()->route('listar_livros');
    }

    public function destroy(Request $request, RemovedorDeLivro $removedorDeLivro)
    {
        $tituloLivro = $removedorDeLivro->removerLivro($request->id);
        $request->session()
            ->flash(
                'mensagem',
                "Lívro $tituloLivro removido com sucesso"
            );

        return redirect()->route('listar_livros');
    }

    public function edit(int $id){
        $livro = Livro::find($id);

        if(!$livro){
            throw new Exception("Livro não encontrado");
        }
        
        return view('livros.editar', compact('livro'));
    }



    public function editaLivro(int $id, Request $request)
    {
        $livro = Livro::find($id);
        
        $novoTitulo = $request->titulo;
        $novoAutor = $request->autor;
        $novoAnoPublicacao = $request->anoPublicacao;
        $novoStatusLivro = $request->statusLivro;
       /* if(($novoStatusLivro != "Disponível") && ($novoStatusLivro != "Alugado") && (strlen($novoAutor)<2) && (strlen($novoTitulo)<3) ){
            $request->session()
            ->flash(
                'mensagem',
                "Autor ou Titulo inválidos, verifique novamente",
                "Tente novamente com um status válido, ou seja, Alugado ou Disponível"
                );
        }else{*/
            $livro->titulo = $novoTitulo;
            $livro->autor = $novoAutor;
            $livro->anoPublicacao = $novoAnoPublicacao;
            $livro->statusLivro = $novoStatusLivro;
           
       // }
        $livro->save();
        return redirect()->route('listar_livros');
    }
}
