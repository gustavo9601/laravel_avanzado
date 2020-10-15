<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'user_id',
        'text',
    ];

    // Un mensaje pertenece a un usuario
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Un mensaje tiene una relacion polimorfica de una nota => notable
    public function note(){

        // en tinker
        // $message->note()->create(['body' => 'nota del usuario 1']);

        // sirve para hasOne o hasMany
        // uno a uno o uno a muchos

        return $this->morphOne(Note::class, 'notable');
    }


    public function tags(){

        // En tinker
        // >>> $message->tags()->create(['name' => 'Importante mensaje'])
        // >>> $message->tags()->save($tag);  // Añadendole una etiqueta existente al mensaje
        // >>> $message->tags()->detach(Medelo tag o id tag);   // Remueve la relacion a la etiqueta

        return $this->morphToMany(Tag::class, 'taggable')->withTimestamps(); // withTimestamps() para que actualice la informacion de los timestamps
    }


}
