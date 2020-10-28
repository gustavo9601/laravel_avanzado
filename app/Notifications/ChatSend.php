<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChatSend extends Notification
{
    use Queueable;

    public $chat;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($chat)
    {
        $this->chat = $chat;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // Especificando los metodos de notificacion
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        // $notifiable
        // Es la variable del usuario actual a notificar

        // Si se define mail, se ejecutara este metodo
        return (new MailMessage)
            ->subject('Mensaje de notificacion')  // Asunto
            ->greeting('Hola Que mas bien o q ?')  // Saludo en la plantilla
            ->line('The introduction to the notification.')  // Texto de linea de contenido
            ->action('Notification Action', url('/'))  //  Boton de llamado a la accion y el link del btn
            ->line('Thank you for using our application!');  // Texto que se envia al contenido




        // Si no queremos usar la plantilla del mensaje por default, se define de la siguientes formas
        // Que plantilla usar y las variables a renderizar

       /*
        Forma #1
       return (new MailMessage)->view('emails.notification')
            ->with(['data' => 'data'])
            ->subject('Mensaje de notificacion');  // Asunto

        Forma #2
       // Usando una clase de mail, mucho mas eficiente
       return (new MailMessage($data))->to($notifiable->email);

        */

    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {

        // Se define que data se almacenara en formato json
        return $this->chat->toArray();
    }
}
