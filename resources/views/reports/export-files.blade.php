@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>Reportes</h1>

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('reports.export-pdf')}}" class="card-link">Export PDF</a>
                </div>
            </div>
        </div>

    </div>
@endsection
