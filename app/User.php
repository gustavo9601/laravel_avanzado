<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Vlidacion de roles
    public function hasRoles(array $roles)
    {


        // Recibe un arreglo de roles permitodss, de encontrar algun en la bd, retornara true
        /*foreach ($roles as $role){
            // $this => al estar en la clase apunta a la clase global User
            foreach ($this->roles as $userRole){
                if ($userRole->name === $role){
                    return true;
                }
            }
        }*/


        return $this->roles
            ->pluck('name')   // Retorna un array con los valores del indice
            ->intersect($roles)  // compara los dos arreglos , y retorna un arreglo con las coincidencias en ambos
            ->count();  // retorna el lenght del arreglo retornado

    }


    // Un usuario pertenece a muchos roles
    public function roles()
    {
        // se especifica el nombre de la tabla
        return $this->belongsToMany(Role::class, 'assigned_roles');
    }

    // retonadndo si en el usuario tiene el rol admin
    public function isAdmin()
    {
        return $this->hasRoles(['admin']);
    }


    public function messages()
    {
        // Un usuario puede tener muchos mensajes
        return $this->hasMany(Message::class);
    }

    // Mutador al atributo password
    public function setPasswordAttribute($value)
    {
        // No usamos el mutador, ya que por defecto laravel ya la encripta
        // $this->attributes['password'] = bcrypt($value);
        $this->attributes['password'] = $value;
    }

}
