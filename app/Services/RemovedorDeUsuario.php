<?php
namespace App\Services;

use App\{Serie, Temporada, Episodio, Livro, Reserva, User};
use Illuminate\Support\Facades\DB;

class RemovedorDeUsuario
{
    public function removerUsuario(int $UsuarioId): string
    {
        $nomeUsuario = '';
        DB::transaction(function () use ($UsuarioId, &$nomeUsuario) {
            $usuario = User::find($UsuarioId);
            $nomeUsuario = $usuario->name;
            $emailUsuario = $usuario->email;
            $senhaUsuario = $usuario->password;
            $usuario->delete();
        });

        return $nomeUsuario;
    }
}
