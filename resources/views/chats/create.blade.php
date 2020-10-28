@extends('layouts.app')

@section('content')



    <div class="container">

        <div class="row">

            <div class="col-md-8 offset-2">

                @if (session()->has('flash'))
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Enhorabuena!!!</h4>
                        <p class="mb-0">{{session('flash')}}</p>
                    </div>
                @endif


                <h1>Nuevo chat</h1>


                <form action="{{route('chats.store')}}" method="POST">
                    @csrf

                    <div class="form-group {{$errors->has('recipient_id') ? 'has-error' : ''}}">
                        <select name="recipient_id" id="" class="form-control">
                            <option selected>Selecciona el usuario</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('recipient_id', '<span class="error">:message</span>') !!}
                    </div>

                    <div class="form-group {{$errors->has('body') ? 'has-error' : ''}}">
                        <label for="body"> Mensaje </label>
                        <textarea  class="form-control" name="body" id="body"></textarea>
                        {{--Laravel reemplazar el primer error encontrado para el campo name, en :message--}}
                        {!! $errors->first('body', '<span class="error">:message</span>') !!}
                    </div>
                    <button type="submit" class="btn btn-block btn-xs btn-primary">Enviar chat</button>

                </form>

            </div>

        </div>



    </div>
@endsection
