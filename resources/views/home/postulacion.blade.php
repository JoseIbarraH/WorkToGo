@extends('layouts\app-master-2')

@section('content')
    <link rel="stylesheet" href="{{ url('assets/css/nav.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/perfil.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @auth

        <br><br><br><br><br><br>
        <h1>Postulacion</h1>
        <div id="postu">
            <form action="{{ route('savepostu') }}" method="POST" class="mt-5" enctype="multipart/form-data">
                @csrf
                <div class="row" style="width: 100%">
                    <div class="col-md-6 card p-3 mb-4 mx-auto imgcaptu" style="width: 500px;">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <h3>Imagen Perfil</h3>
                            <div style="width: 100%; max-height: 250px; height: 250px;">
                                <img id="vistaPrevia" src="" style="width: 100%; max-height: 250px;">
                            </div>
                            <br>
                            <input class="form-control" type="file" name="imagen" id="imagen"
                                accept="image/jpg,image/png,image/jpeg" required>
                        </div>
                    </div>
                    <div class="col-md-6 card p-3 mb-4 mx-auto imgcaptu" style="width: 500px">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <h3>Imagen Cedula</h3>
                            <div style="width: 100%; max-height: 250px; height: 250px;">
                                <img id="vistaPrevia1" src="" style="width: 100%; max-height: 250px;">
                            </div>
                            <br>
                            <input class="form-control" type="file" name="imagen1" id="imagen1"
                                accept="image/jpg,image/png,image/jpeg" required>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="my-5">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Descripciones detalladas de proyectos anteriores</h4>
                            <textarea class="form-control" style="height: 200px; resize: none; overflow-y: scroll;" id="proyectos" name="proyectos"></textarea>
                            <h5 class="mt-3">Incluyendo imágenes si es posible</h5>
                            <input type="file" class="form-control" name="imagenes[]" multiple >
                        </div>
                        <div class="col-md-6">
                            <h4>Detalles sobre el tipo de servicios que ofrece</h4>
                            <textarea class="form-control" style="height: 200px; resize: none; overflow-y: scroll;" id="tipo" name="tipo"></textarea>
                            <button type="submit" class="btn btn-primary mt-5"
                                style="float: right; width: 200px">Postularse</button>
                        </div>
                    </div>
                </div>
                <input value="{{ auth()->user()->id }}" name="id_usuario" hidden>
            </form>
        </div>

        @if (auth()->user()->service === 'Activo' ||
                auth()->user()->service === 'Pendiente' ||
                auth()->user()->service === 'Offline')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var postuDiv = document.getElementById('postu');
                    var elementos = postuDiv.querySelectorAll('*');

                    for (var i = 0; i < elementos.length; i++) {
                        elementos[i].disabled = true;
                    }
                });
            </script>
            <div class="card my-5">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('/storage/assets/img/perfilImagenes/' . auth()->user()->id . '.jpg') }}"
                            alt="" style="width: 200px; height: 150px;">
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6"
                                style="display: flex; justify-content: center; align-items: center; height: 150px;">
                                @if (auth()->user()->service === 'Pendiente')
                                    <div>
                                        <h5 style="text-align: center; color: orange">Estado: {{ auth()->user()->service }}</h5>
                                    </div>
                                @elseif(auth()->user()->service === 'Activo')
                                    <div>
                                        <h5 style="text-align: center; color: green">Estado: {{ auth()->user()->service }}</h5>
                                    </div>
                                @elseif(auth()->user()->service === 'Offline')
                                    <div>
                                        <h5 style="text-align: center; color: rgb(102, 102, 102)">Estado:
                                            {{ auth()->user()->service }}</h5>
                                    </div>
                                @endif
                            </div>
                            <form action="{{route('cancelar')}}" method="POST" enctype="multipart/form-data" style="width: 230px">
                                @csrf
                                @method('put')
                                @if (auth()->user()->service === 'Pendiente')
                                    <div class="col-md-6"
                                        style="height: 150px; display: flex; justify-content: center; align-items: center; width: 100%">
                                        <button class="btn btn-warning" type="submit"
                                            style="width: 230px; float: right;">Cancelar Postulacion</button>
                                    </div>
                                @elseif(auth()->user()->service === 'Activo')
                                    <div class="col-md-6"
                                        style="height: 150px; display: flex; justify-content: center; align-items: center; width: 100%">
                                        <button class="btn btn-danger" type="submit"
                                            style="width: 230px; float: right;">Cancelar Postulacion</button>
                                    </div>
                                @elseif(auth()->user()->service === 'Offline')
                                    <div class="col-md-6"
                                        style="height: 150px; display: flex; justify-content: center; align-items: center; width: 100%">
                                        <button class="btn btn-secondary" type="submit"
                                            style="width: 230px; float: right;">Volver al trabajo</button>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <script src="{{ url('assets/js/script.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @endauth

    @guest
        <br><br><br><br><br><br><br>
        para ver el contenido <a href="/login">Inicia seccion</a>
    @endguest
@endsection
