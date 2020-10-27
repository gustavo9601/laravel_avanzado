<?php

namespace Tests\Feature\integration;

use App\Message;
use App\Repositories\MessagesRepositorie;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class EloquentMessagesTest extends TestCase
{
    // Usando el trait
    // Ejecutara al iniciar cada test la migracion
    // y Al finalizar realizara un roolback sobre la migracion
    use DatabaseMigrations;

    public function tearDown(): void
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
    }

    public function setUp(): void
    {
        // Se debe llamar obligatoriamente para que reconosca los metodos herados de laravel
        parent::setUp();
        $this->messageRepositorie = new MessagesRepositorie();
    }

    /**
     * @test
     */
    public function it_returns_paginated_messages()
    {


        // Given -> Teniendo
        // -> Teniendo mas de 10 mensajes resueltos por eloquent
        // Crea una factoria de 10 mensajes, y le sobrescribirmos el created_at
        $messages = factory(Message::class, 20)->create(['created_at' => Carbon::yesterday()]);
        $lastestMessage = factory(Message::class)->create(['created_at' => Carbon::now()]); // Creamos uno con fecha actual, para poder comporbar el orden

        // When -> Cuando
        // -> Cuando ejecutamos el metodo getPaginated
        $result = $this->messageRepositorie->getPaginated();

        // then -> Entonces
        // -> Entonces debemos obtener solo 10 mensajes y retornarlos
        // 1. La respuesta debe ser de un length de 10
        $this->assertEquals($result->count(), 10);

        // 2. La respuesta deben estar ordenados por fecha de creacion en forma descendente
        // Comprueba que el id del primer registro de la coleccion retornada, sea igual al id del ultimo mensaje creado
        $this->assertEquals($result->first()->id, $lastestMessage->id);

        // 3. La respuesta debe cargar las relaciones, validando el eadger loading correctamente
        $this->assertTrue($result->first()->relationLoaded('user'));  // Verifica la relacion con user
        $this->assertTrue($result->first()->relationLoaded('tags'));  // Verifica la relacion con tags
        $this->assertTrue($result->first()->relationLoaded('note'));  // Verifica la relacion con note

        // 4. La respuesta debe estar paginada
        // Comprueba que sea instancia de LengthAwarePaginator
        $this->assertTrue($result instanceof LengthAwarePaginator);
    }


    /**
     * @test
     */
    function it_stores_a_messages_in_the_database()
    {

        // Teniendo un mensaje para guardar

        $user = factory(User::class)->create();
        // Fake de un login
        $this->actingAs($user);

        // Moke de un request
        $request = new Request([
            'text' => 'Mesaje Mock',
            'user_id' => $user->id
        ]);


        // Cuando ejecute el metodo store
        // Llama al metodo store del repositorio
        $message = $this->messageRepositorie->store($request);


        // Entonces el mensaje debe almacenarce en la base de datos
        // Verifica que exista en la tabla messages, en la columna text, el valor Mesage Mock
        $this->assertDatabaseHas('messages', [
            'text' => $message->text,
        ]);

        // $this->assertDatabaseCount();
    }

    /**
     * @test
     * */
    function a_registered_user_can_store_a_message()
    {
        // Teniendo un usuario registrado y mensae para guardar
        // Creamos un usuario
        $user = factory(User::class)->create();

        // Moke de un request
        $request = new Request([
            'text' => 'Mesaje Mock',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Emulando el login
        $this->actingAs($user);

        // Cuando ejecute el menotod store
        // Llama al metodo store del repositorio
        $message = $this->messageRepositorie->store($request);


        // Entonces el mensaje debe aparecer con el usuario relacionado
        // 1. Debe existir en la bd el registro de un mensaje con id del usuario creado
        $this->assertDatabaseHas('messages', [
            'id' => $message->id,
            'text' => $message->text,
            'user_id' => $user->id,
            'created_at' => $message->created_at->toDateTimeString(),
            'updated_at' => $message->updated_at->toDateTimeString(),
        ]);
    }


    /**
     * @test
     */
    public function it_returns_a_message_by_id()
    {
        // Teniendo un mensjae en la base de datos
        // Creando mensajes de prueba
        $messages = factory(Message::class, 10)->create();
        $message = Message::find($messages->first()->id);

        // Cuando ejecuto el metodo findById
        $messageFind = $this->messageRepositorie->findById($message->id);

        // Entonces debo tener el mismo mensaje pasado por el id parametro
        $this->assertEquals($messageFind->id, $message->id);

    }


    /**
     * @test
     */
    public function it_update_a_message_by_id()
    {
        // Teniendo un mensjae en la base de datos para modificarlo
        // Creando un usuario de prueba
        $user = factory(User::class)->create();
        // Creando mensajes de prueba
        $message = factory(Message::class)->create(['user_id' => $user->id]);
        // Moke de un request para actualizar el message anterior creado
        $request = new Request([
            'text' => 'Actualizando el texto al mensaje',
        ]);

        // Cuando ejecuto el metodo update
        $messageUpdate = $this->messageRepositorie->update($request, $message->id);

        // Entonces debo tener el mismo mensaje actualizado el texto
        $this->assertDatabaseHas('messages', [
            'id' => $message->id,
            'text' => $request->input('text'),
            'user_id' => $user->id,
            'created_at' => $message->created_at->toDateTimeString(),
            'updated_at' => $message->updated_at->toDateTimeString(),
        ]);

    }



    /**
     * @test
     */
    public function it_delete_a_message_by_id()
    {
        // Teniendo un mensjae en la base de datos
        // Creando mensajes de prueba
        $messages = factory(Message::class, 10)->create();
        $message = Message::find($messages->first()->id);

        // Cuando ejecuto el metodo destroy
        // Entonces debo eliminar el recurso dela bd
        $this->messageRepositorie->destroy($message->id);

        // Comprobando que no exista el registro en la bd
        $this->assertDatabaseMissing('messages', [
            'id' => $message->id
        ]);

        // Verifica que se halla eliminado
        $this->assertDeleted('messages', $message->toArray());

    }

}
