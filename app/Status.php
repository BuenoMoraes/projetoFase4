<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $timestamps = false;
    protected $fillable = ['status'];

    public static function fetchPairs()
    {
        return self::query()
        ->orderBy('id') 
        ->get();

    }
}