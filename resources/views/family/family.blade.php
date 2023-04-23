@extends('adminlte::page')


@section('content')

    <div id="app">
        <family-component></family-component>
    </div>
   
@stop


@section('js')

    <script src="{{ asset('js/app.js') }}"></script>
    
@stop