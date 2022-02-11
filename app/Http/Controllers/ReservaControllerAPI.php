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
        $criadorDeReserva = resolve(CriadorDeReserva::class);

        $reserva  = $criadorDeReserva->criarReserva([
            'usuario_id' => $request->usuario_id,
            'livro_id' => $request->livro_id,
            'inicio' => $request->inicio,
            'termino' => $request->termino
        ]);

        return $reserva;
    }

    public function show(int $id)
    {
        $recurso = Reserva::find($id);
        if (is_null($recurso)) {
            return response()->json('', 204);
        }

        return response()->json($recurso);
    }

    public function update(int $id, Request $request)
    {
        $recurso = Reserva::find($id);
        if (is_null($recurso)) {
            return response()->json([
                'erro' => 'Recurso não encontrado'
            ], 404);
        }
        $recurso->fill($request->all());
        $recurso->save();

        return $recurso;
    }

    public function destroy(int $id)
    {
        $qtdRecursosRemovidos = Reserva::destroy($id);
        if ($qtdRecursosRemovidos === 0) {
            return response()->json([
                'erro' => 'Recurso não encontrado'
            ], 404);
        }

        return response()->json('', 204);
    }
}
