@extends('layouts\app-master')

@section('content')
    <link rel="stylesheet" href="{{ url('assets/css/nav.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/perfil.css') }}">
    @auth

        <br><br><br><br>

        <h1>Perfil De Usuario</h1>
        <div class="row">
            <div class="col-md-6 mt-5" style="display: flex; justify-content: center; align-items: center;">
                <div class="">
                    <div style="display: flex; justify-content: center; align-items: center;">
                        <img src="{{ asset('assets/img/perfil/perfil.png') }}" alt="" width="150" height="150"
                        class="rounded-circle ">
                    </div>
                    <input class="form-control mt-3" type="file" name="imagen" id="imagen">
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <span>Cedula: </span>
                        <input type="text" class="form-control" id="firstName" value="{{ auth()->user()->cedula }}" required>
                        <span>Nombre: </span>
                        <input type="text" class="form-control mt-3" id="firstName" value="{{ auth()->user()->nombre }}" required>
                    </div>
                    <div class="col-md-6">
                        <span>Username: </span>
                        <input type="text" class="form-control" id="firstName" value="{{ auth()->user()->username }}" required>
                        <span>Email: </span>
                        <input type="email" class="form-control mt-3" id="firstName" value="{{ auth()->user()->email }}" required>
                    </div>
                </div>
            </div>
        </div>
        <hr>

    @endauth

    @guest
        para ver el contenido <a href="/login">Inicia seccion</a>
    @endguest
@endsection
