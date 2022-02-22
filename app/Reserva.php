<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    public $timestamps = false;
    protected $fillable = ['usuario_id', 'livro_id', 'inicio', 'termino'];

    public static function fetchPairs()
    {
        return self::query()
        ->orderBy('id') 
        ->get();
    }


}