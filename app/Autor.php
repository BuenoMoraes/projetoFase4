<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    public $timestamps = false;
    protected $fillable = ['autor'];

    public static function fetchPairs()
    {
        return self::query()
        ->orderBy('autor') 
        ->get();
    }
}