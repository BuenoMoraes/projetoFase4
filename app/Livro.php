<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    public $timestamps = false;
    protected $fillable = ['titulo', 'autor', 'anoPublicacao', 'statusLivro'];




}