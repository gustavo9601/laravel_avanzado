@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>Mensaje</h1>


        <table class="table">
            <tr>
                <th>Nombre:</th>
                <td>{{$message->name}}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{$message->email}}</td>
            </tr>
            <tr>
                <th>Telefono:</th>
                <td>
                    {{$message->phone}}
                </td>
            </tr>
            <tr>
                <th>Mensaje:</th>
                <td>
                    {{$message->text}}
                </td>
            </tr>
        </table>

        {{--Can verifica el police y de pasar mostrara la info--}}
        {{--recibe la habilitada o funcion del policy y el objeto de clase--}}

        <a href="{{route('messages.edit', $message->id)}}" class="btn btn-info">Editar</a>

        <form
            action="{{route('messages.destroy', $message->id)}}"
            method="POST" style="display: inline">
            @method('DELETE')
            @csrf

            <button class="btn btn-danger btn-xs" type="submit">Eliminar</button>
        </form>


    </div>
@endsection
