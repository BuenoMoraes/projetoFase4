<?php
namespace App\Services;

use App\{Livro, Autor};
use Illuminate\Support\Facades\DB;

class RemovedorDeLivro
{
    public function removerLivro(int $LivroId): string
    {
        $tituloLivro = '';
        DB::transaction(function () use ($LivroId, &$tituloLivro) {
            $livro = Livro::find($LivroId);
            $tituloLivro = $livro->titulo;
            $autorLivro = $livro->autor_id;
            $anoPublicacaoLivro = $livro->anoPublicacao;
            $statusLivroLivro = $livro->statusLivro;
            $livro->delete();
        });

        return $tituloLivro;
    }
}
