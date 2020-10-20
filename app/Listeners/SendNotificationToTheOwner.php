<?php

namespace App\Listeners;

use App\Events\MessageWasReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotificationToTheOwner
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
        \Mail::send('mails.new-message', ['msg' => $message], function ($m) use ($message) {
            $m->from(auth()->user()->email, 'Nombre clietnte')
                ->to('tavo9601@gmail.com', 'Gus IA')
                ->subject('Tu mensaje fue recibido');
        });

    }
}