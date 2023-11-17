@extends('layouts\app-master')

@section('content')
    <link rel="stylesheet" href="{{ url('assets/css/nav.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/home.css') }}">
    @auth
        <br><br>
        <br><br>
        <br><br>
        <h1>Ayuda/PQR</h1>

        <div class="row">
            <div class="col-md-6">

            </div>
            <div class="col-md-6">
                <form action="/pqr/save" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card p-3" style="width: 90%">
                    <div style="text-align: center">
                        <h1>PQR</h1>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-6"> 
                            <label for="titulo" class="mt-2"><h4>Titulo</h4></label>
                            <input class="form-control" type="text" name="titulo" id="titulo" placeholder="Titulo">
                        </div>
                        <div class="col-md-6">
                            <label for="tipo" class="mt-2"><h4>Tipo</h4></label>
                            <select class="form-select" aria-label="Default select example" id="tipo" name="tipo">
                                <option selected disabled>tipo </option>
                                <option value="Pregunta">Pregunta</option>
                                <option value="Queja">Queja</option>
                                <option value="Reclamo">Reclamo</option>
                            </select>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-6">
                            <label for="fechaActual" class="mt-2"><h4>Fecha Actual</h4></label>
                            <input type="date" class="form-select" name="fechaActual" id="fechaActual">
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div> --}}
                    <div>
                        <label for="descripcion" class="mt-2"><h4>Descripcion</h4></label>
                        <textarea class="form-control" name="descripcion" id="descripcion" style="width: 100%; height: 125px;" placeholder="Descripcion"></textarea>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-primary" type="submit">
                            Enviar
                        </button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    @endauth
@endsection
