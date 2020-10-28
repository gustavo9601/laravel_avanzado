@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header p-1">Inicio</div>


                    <div class="card-body p-1">

                        @if (session()->has('flash'))
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Enhorabuena!!!</h4>
                                <p class="mb-0">{{session('flash')}}</p>
                            </div>
                        @endif

                            Bienvenido
                    </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



