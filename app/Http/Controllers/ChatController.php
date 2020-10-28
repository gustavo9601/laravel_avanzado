<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Notifications\ChatSend;
use App\User;
use http\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Que traiga todos los usuarios menos el autenticado
        $users = User::where('id', '!=', auth()->user()->id)->get();

        return view('chats.index')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Que traiga todos los usuarios menos el autenticado
        $users = User::where('id', '!=', auth()->user()->id)->get();

        return view('chats.create')->with(['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //'recipient_id' => 'required|exists:users,id'
        // Verifica que el valor en el campo exista en la tabla users en el campo id
        $this->validate($request,[
            'body' => 'required',
            'recipient_id' => 'required|exists:users,id'
        ]);

        $chat = Chat::create([
            'sender_id' => auth()->user()->id,
            'recipient_id' => $request->input('recipient_id'),
            'body' => $request->input('body'),
        ]);

        $user_recipient = User::find($chat->recipient_id);

        // La funcion la herreda al usar el trait Notifiable
        $user_recipient->notify(new ChatSend($chat));

        return back()->with(['flash' => 'Se envio el chat  correctamente a ' . $user_recipient->name]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
