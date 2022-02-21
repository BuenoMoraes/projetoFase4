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


class ReservasController extends Controller
{
    public function index(Request $request) {
        $reservas = Reserva::fetchPairs();
        $usuario = User::fetchPairs();
        $livro = Livro::fetchPairs();
        
        $mensagem = $request->session()->get('mensagem');

        return view('reservas.index', compact('reservas','usuario', 'livro' ,'mensagem'));
    }

    public function create()
    {
        $usuario = User::fetchPairs();
        $livro = Livro::fetchPairs();
        return view('reservas.create', compact('usuario', 'livro'));
    }

    public function store(
        ReservasFormRequest $request,
        CriadorDeReserva $criadorDeReserva 
    ) {

        $usuario = User::fetchPairs();
        $livro = Livro::fetchPairs();
        $reserva  = $criadorDeReserva->criarReserva([
            'usuario_id' => $request->usuario_id,
            'livro_id' => $request->livro_id,
            'inicio' => $request->inicio,
            'termino' => $request->termino
        ]);
            $request->session()
            ->flash(
                'mensagem',
                "Reserva com id {$reserva->id}, livro {$livro->where('id', $reserva->livro_id)->pluck('titulo')->first()} e usuário {$usuario->where('id', $reserva->usuario_id)->pluck('name')->first()} criado com sucesso "
            );

        return redirect()->route('listar_reservas');
    }

    public function destroy(Request $request, RemovedorDeReserva $removedorDeReserva)
    {
        $nomeLivroReserva = $removedorDeReserva->removerReserva($request->id);
        $request->session()
            ->flash(
                'mensagem',
                "Reserva removida com sucesso"
            );

        return redirect()->route('listar_reservas');
    }

    public function edit(int $id){
        $usuario = User::fetchPairs();
        $livro = Livro::fetchPairs();
        $reserva = Reserva::find($id);

        if(!$reserva){
            throw new Exception("Reserva não encontrada");
        }
        
        return view('Reservas.editar', compact('reserva', 'usuario', 'livro'));
    }

    
    public function editaReserva(int $id, ReservasFormRequest  $request)
    {
        $reserva = Reserva::find($id);
        $novoNomeUsuario = $request->usuario_id;
        $novoNomeLivro = $request->livro_id;
        $novoInicio = $request->inicio;
        $novoTermino = $request->termino;

        $reserva->usuario_id = $novoNomeUsuario;
        $reserva->livro_id = $novoNomeLivro;
        $reserva->inicio = $novoInicio;
        $reserva->termino = $novoTermino;
       
        $reserva->save();
        return redirect()->route('listar_reservas');
    }
}
