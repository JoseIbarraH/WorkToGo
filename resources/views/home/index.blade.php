@extends('layouts\app-master')

@section('content')
    <link rel="stylesheet" href="{{ url('assets/css/nav.css') }}">

    @auth
        <br><br><br><br>
        cositas
    @endauth

    @guest

        para ver el contenido <a href="/login">Inicia seccion</a>
    @endguest
@endsection
