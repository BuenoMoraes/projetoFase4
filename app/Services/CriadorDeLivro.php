<?php

namespace App\Services;

use App\Livro;
use Illuminate\Support\Facades\DB;

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
        
        
        DB::beginTransaction();
        $livro = Livro::create(['titulo' => $titulo, 'autor_id' => $autorId, 'anoPublicacao' => $anoPublicacao, 'status_id' => $statusId ]);
        DB::commit();

        return $livro;
    }
   
}
