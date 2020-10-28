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


                <h1>Notifications</h1>


               <div class="row mt-5">
                   <div class="col-md-6">
                       <h2>Leidas</h2>
                       <hr>
                       <ul class="list-group">
                           @foreach($readNotifications as $readNotification)
                           <li class="list-group-item">{{$readNotification->data['body']}}</li>

                               <form action="{{route('chats.destroy', [$readNotification->id])}}" method="POST" class="pull-right">
                                   @csrf
                                   @method('DELETE')
                                   <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                               </form>
                            @endforeach
                       </ul>

                   </div>
                   <div class="col-md-6">
                       <h2>No Leidas</h2>
                       <hr>
                       <ul class="list-group">
                           @foreach($unreadNotifications as $unreadNotification)
                               {{--Accede al cuerpo de la notificacion a travez de data que es un arreglo--}}
                               <li class="list-group-item">{{$unreadNotification->data['body']}}

                                   <form action="{{route('chats.read', [$unreadNotification->id])}}" method="POST" class="pull-right">
                                       @csrf
                                       <button type="submit" class="btn btn-success btn-xs">Mark read</button>
                                   </form>

                               </li>
                           @endforeach
                       </ul>
                   </div>
               </div>

            </div>

        </div>



    </div>
@endsection
