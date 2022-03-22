<?php
namespace App\Services;

use App\{Livro, Autor};
use Illuminate\Support\Facades\DB;
use Storage;

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
            if($livro->image)
            {
                Storage::delete($livro->image);
            }
        });

        return $tituloLivro;
    }
}
