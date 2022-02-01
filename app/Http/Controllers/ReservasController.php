<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservasFormRequest;
use App\Livro;
use App\Reserva;
use App\Services\CriadorDeReserva;
use App\Services\RemovedorDeReserva;
use App\Temporada;
use Illuminate\Http\Request;
use Exception;


class ReservasController extends Controller
{
    public function index(Request $request) {
        $reservas = Reserva::query()
            ->orderBy('nomeUsuario')
            ->get();
        $mensagem = $request->session()->get('mensagem');

        return view('reservas.index', compact('reservas', 'mensagem'));
    }

    public function create()
    {
        return view('reservas.create');
    }

    public function store(
        ReservasFormRequest $request,
        CriadorDeReserva $criadorDeReserva 
    ) {
        $reserva  = $criadorDeReserva->criarReserva([
            'nomeUsuario' => $request->nomeUsuario,
            'nomeLivro' => $request->nomeLivro,
            'inicio' => $request->inicio,
            'termino' => $request->termino
        ]);
            $request->session()
            ->flash(
                'mensagem',
                "Reserva com id {$reserva->id}, livro {$reserva->nomeLivro} e usuário {$reserva->nomeUsuario} criado com sucesso "
            );

        return redirect()->route('listar_reservas');
    }

    public function destroy(Request $request, RemovedorDeReserva $removedorDeReserva)
    {
        $nomeLivroReserva = $removedorDeReserva->removerReserva($request->id);
        $request->session()
            ->flash(
                'mensagem',
                "Reserva $nomeLivroReserva removido com sucesso"
            );

        return redirect()->route('listar_reservas');
    }

    public function edit(int $id){
        $reserva = Reserva::find($id);

        if(!$reserva){
            throw new Exception("Reserva não encontrada");
        }
        
        return view('Reservas.editar', compact('reserva'));
    }

    
    public function editaReserva(int $id, ReservasFormRequest  $request)
    {
        $reserva = Reserva::find($id);
        $novoNomeUsuario = $request->nomeUsuario;
        $novoNomeLivro = $request->nomeLivro;
        $novoInicio = $request->inicio;
        $novoTermino = $request->termino;

        $reserva->nomeUsuario = $novoNomeUsuario;
        $reserva->nomeLivro = $novoNomeLivro;
        $reserva->inicio = $novoInicio;
        $reserva->termino = $novoTermino;
       
        $reserva->save();
        return redirect()->route('listar_reservas');
    }
}
