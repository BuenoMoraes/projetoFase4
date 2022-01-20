<?php
namespace App\Services;

use App\{Serie, Temporada, Episodio, Livro, Reserva};
use Illuminate\Support\Facades\DB;

class RemovedorDeReserva
{
    public function removerReserva(int $ReservaId): string
    {
        $nomeLivroReserva = '';
        DB::transaction(function () use ($ReservaId, &$nomeLivroReserva) {
            $reserva = Reserva::find($ReservaId);
            $nomeUsuarioReserva = $reserva->nomeUsuario;
            $nomeLivroReserva = $reserva->nomeLivro;
            $inicioReserva = $reserva->inicio;
            $terminoReserva = $reserva->termino;
            $reserva->delete();
        });

        return $nomeLivroReserva;
    }
}
