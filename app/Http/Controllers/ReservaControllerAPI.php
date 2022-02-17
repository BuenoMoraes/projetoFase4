<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservasFormRequest;
use App\Livro;
use App\Reserva;
use App\Services\CriadorDeReserva;
use App\Services\RemovedorDeReserva;
use App\User;
use Illuminate\Http\Request;
use Exception;


class ReservaControllerAPI extends Controller
{
    public function index(Request $request)
    {
        return Reserva::all();
    }

    public function store(Request $request)
    {
        try{
            $criadorDeReserva = resolve(CriadorDeReserva::class);

            $reserva  = $criadorDeReserva->criarReserva([
                'usuario_id' => $request->usuario_id,
                'livro_id' => $request->livro_id,
                'inicio' => $request->inicio,
                'termino' => $request->termino
            ]);
    
            return $reserva;
        }
        catch(Exception $exception){
            return response()->json([
                'erro' => $exception->getMessage(),
            ], 500);
        }
       
    }

    public function show(int $id)
    {
        try{
            $reserva = Reserva::find($id);
        if (is_null($reserva)) {
            return response()->json('Reserva não encontrada', 404);
        }

        return response()->json($reserva);
        }
        catch(Exception $exception){
            return response()->json([
                'erro' => $exception->getMessage(),
            ], 500);
        }
        
    }

    public function update(int $id, Request $request)
    {
        try{
            $reserva = Reserva::find($id);
            if (is_null($reserva)) {
                return response()->json([
                    'erro' => 'Reserva não encontrada'
                ], 404);
            }
            $reserva->fill($request->all());
            $reserva->save();
    
            return $reserva;
        }
        catch(Exception $exception){
            return response()->json([
                'erro' => $exception->getMessage(),
            ], 500);
        }
     
    }

    public function destroy(int $id)
    {
        try{
            $qtdRecursosRemovidos = Reserva::destroy($id);
            if ($qtdRecursosRemovidos === 0) {
                return response()->json([
                    'erro' => 'Reserva não encontrada'
                ], 404);
            }
    
            return response()->json('Reserva excluída', 204);
        }
        catch(Exception $exception){
            return response()->json([
                'erro' => $exception->getMessage(),
            ], 500);
        }
        
    }
}
