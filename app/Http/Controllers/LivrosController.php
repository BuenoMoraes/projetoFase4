<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivrosFormRequest;
use App\Livro;
use App\Services\CriadorDeLivro;
use App\Services\RemovedorDeLivro;
use App\Status;
use App\Autor;
use Illuminate\Http\Request;
use Exception;


class LivrosController extends Controller
{
    public function index(Request $request) {
        $livros = Livro::query()
            ->orderBy('titulo')
            ->get();

        $autor = Autor::fetchPairs();


        $mensagem = $request->session()->get('mensagem');

        return view('livros.index', compact('autor','livros', 'mensagem'));
    }

    public function create()
    {
        $autor = Autor::fetchPairs();
        $status = Status::fetchPairs();

        return view('livros.create', compact('autor', 'status'));
    }

    public function store(
        LivrosFormRequest $request,
        CriadorDeLivro $criadorDeLivro 
    ) {
        $livro  = $criadorDeLivro->criarLivro([
            'titulo' => $request->titulo,
            'autor_id' => $request->autor_id,
            'anoPublicacao' => $request->anoPublicacao,
            'status_id' => $request->status_id
        ]);

            $request->session()
            ->flash(
                'mensagem',
                "Lívro com id {$livro->id} e título {$livro->titulo} criado com sucesso "
            );

            
        
        return redirect()->route('listar_usuarios');
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



    public function editaLivro(int $id, LivrosFormRequest $request)
    {
        $livro = Livro::find($id);
        
        $novoTitulo = $request->titulo;
        $novoAutor = $request->autor_id;
        $novoAnoPublicacao = $request->anoPublicacao;
        $novoStatusLivro = $request->status_id;

        $livro->titulo = $novoTitulo;
        $livro->autor_id = $novoAutor;
        $livro->anoPublicacao = $novoAnoPublicacao;
        $livro->status_id = $novoStatusLivro;
           
   
        $livro->save();
        return redirect()->route('listar_livros');
    }
}
