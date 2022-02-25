<?php

namespace App\Services;

use App\Reserva;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use \Exception;
use App\Http\Requests\ReservasFormRequest;

class CriadorDeReserva
{
    public function salvarReserva(array $informacoes): Reserva 
    {   
        try{
            $id = $informacoes['id'] ?? null;
            $usuarioId = isset($informacoes['usuario_id']) ? $informacoes['usuario_id'] : null;
            $livroId = isset($informacoes['livro_id']) ? $informacoes['livro_id'] : null;
            $inicio = $informacoes['inicio'] ?? null;
            $termino = $informacoes['termino'] ?? null;
            
            $reservasFormRequest = resolve(ReservasFormRequest::class);

            $validator = Validator::make($informacoes, $reservasFormRequest->rules(), $reservasFormRequest->messages(), $reservasFormRequest->attributes());
        
            DB::beginTransaction();
            if(!$id){
                $reserva = Reserva::create(['usuario_id' => $usuarioId, 'livro_id' => $livroId, 'inicio' => $inicio, 'termino' => $termino ]);
            } else {
                Reserva::where('id', $id)
                ->update(['usuario_id' => $usuarioId, 'livro_id' => $livroId, 'inicio' => $inicio, 'termino' => $termino]);

                $reserva = Reserva::find($id);

            }
            DB::commit();

            return $reserva;
        }
        catch(Exception $exception){

            throw new Exception($exception->getMessage());
        
        }
    }

}