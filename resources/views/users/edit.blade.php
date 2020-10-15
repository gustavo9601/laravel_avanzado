@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>Editar usuario</h1>


        <form action="{{route('users.update', $user->id)}}" method="POST">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label for="name"> Nombre </label>
                <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                {{--Laravel reemplazar el primer error encontrado para el campo name, en :message--}}
                {!! $errors->first('name', '<span class="error">:message</span>') !!}

            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="name" value="{{$user->email}}">
                {{--Laravel reemplazar el primer error encontrado para el campo name, en :message--}}
                {!! $errors->first('email', '<span class="error">:message</span>') !!}

            </div>

            <div class="custom-checkbox">

                @foreach($roles as $role)
                    <label for="">
                        <input
                            type="checkbox"
                            name="roles[]"
                            value="{{$role->id}}"

                            {{$user->roles->pluck('id')->contains($role->id) ? 'checked' : ''}}
                        >
                        {{$role->display_name}}
                    </label>
                @endforeach
            </div>

            <button type="submit" class="btn btn-block btn-xs btn-primary">Actualizar</button>


        </form>


    </div>
@endsection
