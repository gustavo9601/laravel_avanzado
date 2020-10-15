@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>{{$user->name}}</h1>


        <table class="table">
            <tr>
                <th>Nombre:</th>
                <td>{{$user->name}}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{$user->email}}</td>
            </tr>
            <tr>
                <th>Roles:</th>
                <td>
                    @foreach($user->roles as $role)
                        {{$role->display_name}}
                    @endforeach
                </td>
            </tr>
        </table>

        {{--Can verifica el police y de pasar mostrara la info--}}
        {{--recibe la habilitada o funcion del policy y el objeto de clase--}}
        @can('edit', $user)
            <a href="{{route('users.edit', $user->id)}}" class="btn btn-info">Editar</a>

            <form
                action="{{route('users.destroy', $user->id)}}"
                method="POST" style="display: inline">
                @method('DELETE')
                @csrf

                <button class="btn btn-danger btn-xs" type="submit">Eliminar</button>
            </form>
        @endcan


    </div>
@endsection
