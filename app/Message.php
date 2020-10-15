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


}
