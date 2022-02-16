<?php

namespace App\Services;

use App\Livro;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use \Exception;
use App\Http\Requests\LivrosFormRequest;

class CriadorDeLivro
{
    /*public function criarLivro(
        string $titulo,
        string $autor,
        string $anoPublicacao,
        string $statusLivro
    ): Livro {
        DB::beginTransaction();
        $livro = Livro::create(['titulo' => $titulo, 'autor' => $autor, 'anoPublicacao' => $anoPublicacao, 'statusLivro' => $statusLivro ]);
        DB::commit();

        return $livro;
    }*/

    public function criarLivro(array $informacoes): Livro 
    {
        $titulo = isset($informacoes['titulo']) ? $informacoes['titulo'] : null;
        $autorId = $informacoes['autor_id'] ?? null;
        $anoPublicacao = $informacoes['anoPublicacao'] ?? null;
        $statusId = $informacoes['status_id'] ?? null;
        
        $livrosFormRequest = resolve(LivrosFormRequest::class);

        $validator = Validator::make($informacoes, ['titulo' => 'required|min:2',
        'anoPublicacao' => 'required|min:4',
        'autor_id' => 'required|',
        'status_id' => 'required']);
    
        if ($validator->fails()) {
            throw new Exception("teste exception");
        }
        DB::beginTransaction();
        $livro = Livro::create(['titulo' => $titulo, 'autor_id' => $autorId, 'anoPublicacao' => $anoPublicacao, 'status_id' => $statusId ]);
        DB::commit();

        return $livro;
    }
   
}
