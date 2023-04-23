@extends('adminlte::page')


@section('content')

    <div id="app">
        <church-component></church-component>
    </div>
   
@stop


@section('js')

    <script src="{{ asset('js/app.js') }}"></script>
    
@stop