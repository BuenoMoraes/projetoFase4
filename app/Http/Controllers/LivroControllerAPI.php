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


class LivroControllerAPI extends Controller
{
    public function index(Request $request)
    {
        return Livro::all();
    }

    public function store(Request $request)
    {
        $criadorDelivro = resolve(CriadorDeLivro::class);

        $livro  = $criadorDelivro->criarLivro([
            'titulo' => $request->titulo,
            'autor_id' => $request->autor_id,
            'anoPublicacao' => $request->anoPublicacao,
            'status_id' => $request->status_id
        ]);

        return $livro;
    }

    public function show(int $id)
    {
        $recurso = Livro::find($id);
        if (is_null($recurso)) {
            return response()->json('', 204);
        }

        return response()->json($recurso);
    }

    public function update(int $id, Request $request)
    {
        $recurso = Livro::find($id);
        if (is_null($recurso)) {
            return response()->json([
                'erro' => 'Recurso não encontrado'
            ], 404);
        }
        $recurso->fill($request->all());
        $recurso->save();

        return $recurso;
    }

    public function destroy(int $id)
    {
        $qtdRecursosRemovidos = Livro::destroy($id);
        if ($qtdRecursosRemovidos === 0) {
            return response()->json([
                'erro' => 'Recurso não encontrado'
            ], 404);
        }

        return response()->json('', 204);
    }
}
