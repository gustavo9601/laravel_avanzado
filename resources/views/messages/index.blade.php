@extends('layouts.app')

@section('content')

    <h1>Mensajes
        <a href="{{route('messages.create')}}" class="btn btn-xs float-right btn-primary">Crear mensaje</a>
    </h1>

    @if (session()->has('info'))
        <div class="alert alert-success">{{session('info')}}</div>
    @endif

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Texto</th>
            <th>Notas</th>
            <th>Tags</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($messages as $message)
            <tr>
                <th>{{$message->id}}</th>
                {{--Accede al nombre del usuario atravez de la relacion--}}
                <th>{{$message->user->name}}</th>
                <th>{{$message->user->email}}</th>
                <th>{{$message->text}}</th>
                {{--Accede a traves de la relacion polimorfica--}}
                <th>{{$message->note->body ?? ''}}</th>

                <th>{{$message->tags->pluck('name')->implode(' - ')  ?? ''}}</th>
                <th>

                    <a href="{{route('messages.edit', $message->id)}}" class="btn btn-info btn-xs">Editar</a>
                    <a href="{{route('messages.show', $message->id)}}" class="btn btn-warning btn-xs">Ver</a>

                    <form
                        action="{{route('messages.destroy', $message->id)}}"
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
