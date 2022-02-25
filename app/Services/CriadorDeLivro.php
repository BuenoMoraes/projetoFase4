<?php

namespace App\Services;

use App\Livro;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use \Exception;
use App\Http\Requests\LivrosFormRequest;

class CriadorDeLivro
{
    public function salvarLivro(array $informacoes): Livro 
    {
        try{
            $id = $informacoes['id'] ?? null;
            $titulo = isset($informacoes['titulo']) ? $informacoes['titulo'] : null;
            $autorId = $informacoes['autor_id'] ?? null;
            $anoPublicacao = $informacoes['anoPublicacao'] ?? null;
            $statusId = $informacoes['status_id'] ?? null;
            
            $livrosFormRequest = resolve(LivrosFormRequest::class);
            $validator = Validator::make($informacoes,  $livrosFormRequest->rules(), $livrosFormRequest->messages(), $livrosFormRequest->attributes() );
        
            DB::beginTransaction();
            if(!$id){
                $livro = Livro::create(['titulo' => $titulo, 'autor_id' => $autorId, 'anoPublicacao' => $anoPublicacao, 'status_id' => $statusId ]);
            } else {
                Livro::where('id', $id)
                ->update(['titulo' => $titulo, 'autor_id' => $autorId, 'anoPublicacao' => $anoPublicacao, 'status_id' => $statusId]);

                $livro = Livro::find($id);

            }
            DB::commit();

            return $livro;

        }
        catch(Exception $exception){

            throw new Exception($exception->getMessage());
        
        }
    }
   
}
