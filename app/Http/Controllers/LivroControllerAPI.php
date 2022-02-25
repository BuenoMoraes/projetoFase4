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
        try{
            $criadorDelivro = resolve(CriadorDeLivro::class);

            $livro  = $criadorDelivro->salvarLivro([
                'titulo' => $request->titulo,
                'autor_id' => $request->autor_id,
                'anoPublicacao' => $request->anoPublicacao,
                'status_id' => $request->status_id
            ]);
    
            return $livro;
        }
        catch(Exception $exception){
            return response()->json([
                'erro' => $exception->getMessage(),
            ], 500);
        }
    }

    public function show(int $id)
    {
        try{
            $livro = Livro::find($id);
            if (is_null($livro)) {
                return response()->json('Livro não encontrado', 404);
            }

            return response()->json($livro);
        }
        catch(Exception $exception){
            return response()->json([
                'erro' => $exception->getMessage(),
            ], 500);
        }
       
        
    }

    public function update(int $id, Request $request)
    {
        try{
            $criadorDelivro = resolve(CriadorDeLivro::class);

            $livro  = $criadorDelivro->salvarLivro([
                'id' => $id,
                'titulo' => $request->titulo,
                'autor_id' => $request->autor_id,
                'anoPublicacao' => $request->anoPublicacao,
                'status_id' => $request->status_id
            ]);
    

            return $livro;
        }
        catch(Exception $exception){
            return response()->json([
                'erro' => $exception->getMessage(),
            ], 500);
        }
    }

    public function destroy(int $id)
    {
        try{
            $qtdRecursosRemovidos = Livro::destroy($id);
            if ($qtdRecursosRemovidos === 0) {
                return response()->json([
                    'erro' => 'Livro não encontrado'
                ], 404);
            }
    
            return response()->json('', 204);
        }
        catch(Exception $exception){
            return response()->json([
                'erro' => $exception->getMessage(),
            ], 500);
        }
        
    }
}
