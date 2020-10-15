<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMessageRequest;
use App\Message;
use http\Client\Curl\User;
use Illuminate\Http\Request;

class MessagesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
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
        $mesages = Message::with(['user', 'tags', 'note'])->get();

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMessageRequest $request)
    {
        $message = Message::create($request->all());

        // Usuario con el que se autentico
        $userAuth = auth()->user();

        // Le añade el mensaje con el id identificado
        // ->create($message)
        $userAuth->messages()->save($message);


        return redirect()->route('messages.index')->with(['info' => 'Usuario creado correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::findOrFail($id);

        return view('messages.show')->with(['message' => $message]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = Message::findOrFail($id);
        return view('messages.edit')->with(['btnText' => 'Editar mensaje', 'message' => $message]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateMessageRequest $request, $id)
    {
        $message = Message::findOrFail($id);

        $message->update($request->all());

        return redirect()->route('messages.index')->with(['info' => 'Mensaje actualizado']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::findOrFail($id);

        $message->delete();

        return redirect()->back()->with(['info' => 'Mensaje eliminado correctamente']);
    }
}
