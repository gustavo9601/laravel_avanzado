<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    // Funcion que se ejecuta antes que cualquir otra
    // permitiendo verificar que si es un usuario administrador permita la peticion
    public function before(User $authUser, $ability)
    {
        if ($authUser->isAdmin()){
            return true;
        }
    }


    // Metodo de verificacion de politica
    // recibe en primer parametro el usuario atenticado actual, pero no se pasa al llamar la funcion laravel lo pone automaticamente
    // Por consistencia deberai llevar el mismo nombre de la funcion que usara esta validacion
    public function edit(User $authUser, User $user)
    {
        // Retornara si es el mismo id autenticado al pasado por parametro
        return $authUser->id === $user->id;

    }
}
