<?php

namespace App\Presenters;

use App\User;


class UserPresenter{

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function nombreMasEmail(){
        return 'Nombre: ' . $this->user->name . ' + Email: ' . $this->user->email;
    }


}

