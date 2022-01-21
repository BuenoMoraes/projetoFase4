<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivrosFormRequest;
use App\Livro;
use App\Services\CriadorDeLivro;
use App\Services\RemovedorDeLivro;
use App\Temporada;
use Illuminate\Http\Request;

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



    public function editalivro(int $id, Request $request)
    {
        $livro = Livro::find($id);
        $novotitulo = $request->titulo;
        $livro->titulo = $novotitulo;
        $livro->save();
    }
}
