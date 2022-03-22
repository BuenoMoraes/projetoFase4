<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Livro extends Model
{
    public $timestamps = false;
    protected $fillable = ['titulo', 'autor_id', 'anoPublicacao', 'status_id', 'image'];

    public static function fetchPairs()
    {
        return self::query()
        ->orderBy('titulo') 
        ->get();
    }

    public function getImageUrlAttribute(){
        if($this->image)
        {
            return Storage::url($this->image);
        }

        return Storage::url('livro/sem-imagem.jpg');

    }

}