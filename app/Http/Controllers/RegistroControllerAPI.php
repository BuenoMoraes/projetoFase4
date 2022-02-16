<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\RemovedorDeUsuario;
use App\Http\Requests\RegistrosFormRequest;
use Exception;


class RegistroControllerAPI extends Controller
{
    public function index(RegistrosFormRequest $request)
    {
        return User::all();
    }

    public function store(RegistrosFormRequest $request)
    {
        try{
            $data = $request->except('_token');
            /*Criptografia*/ 
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);
    
            return $user;
        }
        catch(Exception $exception){
            return response()->json([
                'erro' => $exception
            ], 500);
        }
        
    }

    public function show(int $id)
    {
        try{
            $user = User::find($id);
            if (is_null($user)) {
                return response()->json('', 204);
            }

            return response()->json($user);
        }
        catch(Exception $exception){
            return response()->json([
                'erro' => $exception
            ], 500);
        }
        
    }

    public function update(int $id, RegistrosFormRequest $request)
    {
        try{
            $user = User::find($id);
            if (is_null($user)) {
                return response()->json([
                    'erro' => 'user não encontrado'
                ], 404);
            }
            $user->fill($request->all());
            $user->save();
    
            return $user;
        }
        catch(Exception $exception){
            return response()->json([
                'erro' => $exception
            ], 500);
        }
       
    }

    public function destroy(int $id)
    {
        try{
            $qtdRecursosRemovidos = User::destroy($id);
        if ($qtdRecursosRemovidos === 0) {
            return response()->json([
                'erro' => 'Recurso não encontrado'
            ], 404);
        }

        return response()->json('', 204);
        }
        catch(Exception $exception){
            return response()->json([
                'erro' => $exception
            ], 500);
        }
        
        
    }
}
