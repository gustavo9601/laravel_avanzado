<?php

namespace App\Listeners;

use App\Events\MessageWasReceived;
use App\Mail\TuMensajeFueRecibido;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNotificationToTheOwner implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param  MessageWasReceived  $event
     * @return void
     */
    public function handle(MessageWasReceived $event)
    {
        //
        // dd($event->message);

        // \Mail::send('vista', [data], function(){});
        $message = $event->message;


        $userAuth = auth()->user();

        Mail::to($userAuth->email)->send(new TuMensajeFueRecibido($message));



     /*   \Mail::send('mails.new-message', ['msg' => $message], function ($m) use ($message) {
            $m->from('ing.gustavo.marquez@gmail.com', 'Nombre clietnte')
                ->to('tavo9601@gmail.com', 'Gus IA')
                ->subject('Tu mensaje fue recibido');
        });*/

    }
}
