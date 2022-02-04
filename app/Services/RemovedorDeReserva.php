<?php
namespace App\Services;

use App\{Livro, Reserva};
use Illuminate\Support\Facades\DB;

class RemovedorDeReserva
{
    public function removerReserva(int $ReservaId): string
    {
        $nomeLivroReserva = '';
        DB::transaction(function () use ($ReservaId, &$nomeLivroReserva) {
            $reserva = Reserva::find($ReservaId);
            $nomeUsuarioReserva = $reserva->usuario_id;
            $nomeLivroReserva = $reserva->livro_id;
            $inicioReserva = $reserva->inicio;
            $terminoReserva = $reserva->termino;
            $reserva->delete();
        });

        return $nomeLivroReserva;
    }
}
