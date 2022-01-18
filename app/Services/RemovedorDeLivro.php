<?php
namespace App\Services;

use App\{Serie, Temporada, Episodio, Livro};
use Illuminate\Support\Facades\DB;

class RemovedorDeLivro
{
    public function removerLivro(int $LivroId): string
    {
        $tituloLivro = '';
        DB::transaction(function () use ($LivroId, &$tituloLivro) {
            $livro = Livro::find($tituloLivro);
            $tituloLivro = $livro->titulo;
            $autorLivro = $livro->autor;
            $anoPublicacaoLivro = $livro->anoPublicacao;
            $statusLivroLivro = $livro->statusLivro;
            $livro->delete();
        });

        return $tituloLivro;
    }
}
