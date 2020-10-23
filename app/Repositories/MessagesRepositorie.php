<?php


namespace App\Repositories;

use App\Interfaces\MessagesInterface;
use App\Message;

class MessagesRepositorie implements MessagesInterface
{


    public function getPaginated()
    {

        // Alternativa # 2

        return Message::with(['user', 'tags', 'note'])
            //->latest()  // ordena por fecha de creacion
            ->orderBy('created_at', request()->input('sorted', 'ASC')) // ordena y capta si recibe por la url get el parametro de ordenamiento
            ->paginate(10);

    }

    public function store($request)
    {
        $message = Message::create($request->all());


        // Usuario con el que se autentico
        $userAuth = auth()->user();

        // Le añade el mensaje con el id identificado
        // ->create($message)
        $userAuth->messages()->save($message);


        return $message;
    }


    public function findById($id)
    {
        return Message::findOrFail($id);;
    }


    public function update($request, $id)
    {
        $message = Message::findOrFail($id);

        $message->update($request->all());

        return $message;

    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);

        $message->delete();


        return $message;
    }

}
