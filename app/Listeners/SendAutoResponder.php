<?php

namespace App\Listeners;

use App\Events\MessageWasReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAutoResponder implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param MessageWasReceived $event
     * @return void
     */
    public function handle(MessageWasReceived $event)
    {
        //
       // dd($event->message);

        // \Mail::send('vista', [data], function(){});
        $message = $event->message;
        \Mail::send('mails.new-message', ['msg' => $message], function ($m) use ($message) {
            $m->to('ing.gustavo.marquez@gmail.com', 'Nombre clietnte')->subject('Tu mensaje fue recibido');
        });

    }
}
