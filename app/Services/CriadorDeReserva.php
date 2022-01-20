<?php

namespace App\Services;

use App\Reserva;
use Illuminate\Support\Facades\DB;

class CriadorDeReserva
{
    public function criarReserva(array $informacoes): Reserva 
    {
        $nomeUsuario = isset($informacoes['nomeUsuario']) ? $informacoes['nomeUsuario'] : null;
        $nomeLivro = isset($informacoes['nomeLivro']) ? $informacoes['nomeLivro'] : null;
        $inicio = $informacoes['inicio'] ?? null;
        $termino = $informacoes['termino'] ?? null;
        
        
        DB::beginTransaction();
        $reserva = Reserva::create(['nomeUsuario' => $nomeUsuario, 'nomeLivro' => $nomeLivro, 'inicio' => $inicio, 'termino' => $termino ]);
        DB::commit();

        return $reserva;
    }

}