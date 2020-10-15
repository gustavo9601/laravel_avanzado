@extends('layouts.app')

@section('content')

    <h1>Usuarios</h1>

    @if (session()->has('info'))
        <div class="alert alert-success">{{session('info')}}</div>
    @endif

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Role</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th>{{$user->id}}</th>
                <th>{{$user->name}}</th>
                <th>{{$user->email}}</th>
                {{--Accede a travez de la relacion roles--}}
                <th>
                    {{--@foreach($user->roles as $role)
                        {{$role->display_name}},
                    @endforeach--}}

                    {{--Usando forma de colecciones--}}
                    {{  $user->roles->pluck('display_name')->implode(' - ') }}
                </th>
                <th>

                    <a href="{{route('users.edit', $user->id)}}" class="btn btn-info btn-xs">Editar</a>
                    <a href="{{route('users.show', $user->id)}}" class="btn btn-warning btn-xs">Ver</a>
                    <form
                        action="{{route('users.destroy', $user->id)}}"
                        method="POST" style="display: inline">
                        @method('DELETE')
                        @csrf

                        <button class="btn btn-danger btn-xs" type="submit">Eliminar</button>
                    </form>

                </th>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
