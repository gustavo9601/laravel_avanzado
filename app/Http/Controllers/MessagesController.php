<?php

namespace App\Http\Controllers;

use App\Decorators\CacheMessagesDecorator;
use App\Events\MessageWasReceived;
use App\Http\Requests\CreateMessageRequest;
use App\Message;
use App\Repositories\messagesDecorator;
use http\Client\Curl\User;
use Illuminate\Http\Request;

class MessagesController extends Controller
{


    private $messagesDecorator;

    // Instanciando el repositorio que contiene la logica de la BD
    public function __construct(CacheMessagesDecorator $messagesDecorator)
    {
        $this->middleware(['auth']);

        $this->messagesDecorator = $messagesDecorator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $mesages = Message::all();
        // Se especifica que realice edger loading para cargar en un solo query varios modelos
        // recibe en el arreglo, los modelos a realizar el join

        // $mesages = Message::with(['user', 'tags', 'note'])->get();
        // return $mesages = Message::with(['user', 'tags', 'note'])->paginate(10);  // retorna como objeto todos los datos de la paginacion
        // return $mesages = Message::with(['user', 'tags', 'note'])->simplePaginate(10); // retorna como objeto los datos de pagina siguiente y atras


        $mesages = $this->messagesDecorator->getPaginated();

        return view('messages.index')->with(['messages' => $mesages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('messages.create')->with(['btnText' => 'Enviar mensaje']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMessageRequest $request)
    {
        $message = $this->messagesDecorator->store($request);

        // Ejecutando el evento
        event(new MessageWasReceived($message));

        return redirect()->route('messages.index')->with(['info' => 'Usuario creado correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = $this->messagesDecorator->findById($id);

        return view('messages.show')->with(['message' => $message]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $message = $this->messagesDecorator->findById($id);

        return view('messages.edit')->with(['btnText' => 'Editar mensaje', 'message' => $message]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateMessageRequest $request, $id)
    {
        $message =  $this->messagesDecorator->update($request, $id);

        return redirect()->route('messages.index')->with(['info' => 'Mensaje actualizado']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = $this->messagesDecorator->destroy($id);

        return redirect()->back()->with(['info' => 'Mensaje eliminado correctamente']);
    }
}
