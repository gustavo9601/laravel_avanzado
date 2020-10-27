<?php

namespace App\Decorators;

use App\Interfaces\MessagesInterface;
use App\Repositories\MessagesRepositorie;

class CacheMessagesDecorator implements MessagesInterface
{

    protected $messagesRepositorie;


    public function __construct(MessagesRepositorie $messagesRepositorie)
    {
        $this->messagesRepositorie = $messagesRepositorie;
    }

    public function getPaginated(){
        // Creando un indice dinamico por la variable get page
        $key = "messages.page." . request()->input('page', 1);

        /*
         * Alternativa # 1 de almacenar cache
         * if (\Cache::has($key)){
            $mesages = \Cache::get($key);
        }else{
             $mesages = Message::with(['user', 'tags', 'note'])
                //->latest()  // ordena por fecha de creacion
                ->orderBy('created_at', request()->input('sorted', 'ASC') ) // ordena y capta si recibe por la url get el parametro de ordenamiento
                ->paginate(10);

            \Cache::put($key, $mesages, 1440);

        }*/

        // Alternativa # 2
        return \Cache::tags('messages')->rememberForever($key, function () {
            // Encapsulando o decorando la funcion
            return $this->messagesRepositorie->getPaginated();
        });

    }

    public function store($request){

        $message = $this->messagesRepositorie->store($request);

        // Limpiando la cache para el tag messages
        \Cache::tags('messages')->flush();

        return $message;

    }

    public function findById($id){
        return \Cache::tags('messages')->rememberForever('messages.' . $id, function () use ($id) {
            return $this->messagesRepositorie->findById($id);
        });
    }

    public function update($request, $id){
        $message = $this->messagesRepositorie->update($request, $id);

        \Cache::tags('messages')->flush();

        return $message;
    }

    public function destroy($id){

        $message = $this->messagesRepositorie->destroy($id);

        \Cache::tags('messages')->flush();

        return $message;

    }
}
