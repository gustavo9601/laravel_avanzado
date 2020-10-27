<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

use App\User;
use App\Http\Requests\UpdateUserRequest;


class UsersController extends Controller
{

    function __construct()
    {

        // Pasando parametros al middleare 'nameMiddleware:params,param2,param3'
        $this->middleware(['auth'])->except(['show']);

        $this->middleware(['roles:admin,estudiante'])->except(['edit', 'update', 'show']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::all();

        $users = User::with(['messages', 'roles', 'note', 'tags'])->get();


        return view('users.index')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show')->with(['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        // Usando la politica de acceso
        // se pasa por parametro el nombre de la funciona a ejecutar en el policy
        $this->authorize('edit', $user);

        $roles = Role::all();

        return view('users.edit')->with(['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {


        $user = User::findOrFail($id);

        // Usando la politica de acceso
        // se pasa por parametro el nombre de la funciona a ejecutar en el policy
        $this->authorize('edit', $user);

        // Si se envia la imagen
        if ($request->hasFile('avatar')){
            $user->avatar =  $request->file('avatar')->store('public');
        }

        $user->update($request->all());

        // Accediendo atravez de la relacion

        // $user->roles()->attach($request->roles);   // sirve si se crea un usuario nuevo
        // usamos sync para evitar que se inserte registros dobles de un mismo rol par aun usuario
        $user->roles()->sync($request->roles);

        return redirect()->route('users.index')->with(['info' => 'Usuario ' . $user->name . 'actualizado']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('edit', $user);

        $user->delete();

        return redirect()->back()->with(['info' => 'Usuario ' . $user->name . ' eliminado satisfactoriamente']);
    }

    public function getImageUser($id){
        $user = User::findOrFail($id);
        return \Storage::get($user->avatar);
    }

}
