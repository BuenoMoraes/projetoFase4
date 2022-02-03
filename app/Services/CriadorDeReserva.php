<?php

namespace App\Services;

use App\Reserva;
use Illuminate\Support\Facades\DB;

class CriadorDeReserva
{
    public function criarReserva(array $informacoes): Reserva 
    {
        $usuarioId = isset($informacoes['usuario_id']) ? $informacoes['usuario_id'] : null;
        $livroId = isset($informacoes['livro_id']) ? $informacoes['livro_id'] : null;
        $inicio = $informacoes['inicio'] ?? null;
        $termino = $informacoes['termino'] ?? null;
        
        
        DB::beginTransaction();
        $reserva = Reserva::create(['usuario_id' => $usuarioId, 'livro_id' => $livroId, 'inicio' => $inicio, 'termino' => $termino ]);
        DB::commit();

        return $reserva;
    }

}