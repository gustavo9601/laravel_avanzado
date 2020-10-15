<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
      'body'
    ];

    // Relacion polimorfica de una nota a muchos tipos de modelo
    public function notable(){
        return $this->morphTo();
    }

}
