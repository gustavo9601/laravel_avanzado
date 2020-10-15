<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    // Un role tiene muchos usuarios
    public function users(){
        return $this->hasMany(User::class);
    }
}
