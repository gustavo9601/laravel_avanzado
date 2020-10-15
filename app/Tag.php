<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name'
    ];

    // Al ser una relacion de muchos a muchos en el modelo polimorfico
    // se hace la relacion individual para todos los modelo s que se requieran
    public function messages()
    {
        // taggable nombre de la relacion y type especificado en la migracion
        return $this->morphedByMany(Message::class, 'taggable');
    }

    public function users()
    {
        return $this->morphedByMany(User::class, 'taggable');
    }
}
