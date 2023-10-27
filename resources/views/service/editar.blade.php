@extends('layouts\app-master-2')
@section('content')

<div class="col-2 mt-2" style="width: 40%; height: auto;">
    <div class="card p-3 mb-5" style="width: 450px">
        <div class="card-text">
            <h1 class="p-3" style="text-align: center">Editar Servicio</h1>
            <hr>
        </div>
        <form action="{{route('gestionJobs.update', $servicio )}}" method="POST" enctype="multipart/form-data">

            @csrf

            @method('put')
            <div>

                <!-- Titulo del trabajo-->
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label" for="form3Example1">Titulo: </label>
                        <input type="text" required id="form3Example1" placeholder="Titulo del trabajo"
                            class="form-control" name="titulo" value="{{$servicio->titulo}}" />
                    </div>
                    <!-- tipos de trabajos-->
                    <div class="col-md-6 mb-4">
                        <label class="form-label" for="form3Example1">Tipos De Trabajos: </label>
                        <select class="form-select" required aria-label="Default select example" value="{{$servicio->tipoServicio}}"
                            name="tipoServicio">
                            <option selected disabled>Tipos De Trabajos</option>
                            <option value="Jardineria" {{$servicio->tipoServicio == 'Jardineria' ? 'selected' : ''}}>Jardineria</option>
                            <option value="Plomeria" {{$servicio->tipoServicio == 'Plomeria' ? 'selected' : ''}}>Plomeria</option>
                            <option value="Fachada" {{$servicio->tipoServicio == 'Fachada' ? 'selected' : ''}}>Fachada</option>
                            <option value="Carpinteria" {{$servicio->tipoServicio == 'Carpinteria' ? 'selected' : ''}}>Carpinteria</option>
                            <option value="Electronica" {{$servicio->tipoServicio == 'Electronica' ? 'selected' : ''}}>Electronica</option>
                            <option value="Otro" {{$servicio->tipoServicio == 'Otro' ? 'selected' : ''}}>Otro</option>
                        </select>
                    </div>
                </div>

                <!-- Descripcion del trabajo -->
                <div class="form-outline mb-3">
                    <label class="form-label" for="form3Example4">Descripcion: </label>
                    <textarea name="descripcion" required class="form-control" style="width: 100%; height: 100px;"
                        placeholder="Descripcion del trabajo">{{$servicio->descripcion}}</textarea>
                </div>

                <!-- Costo del trabajo -->
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label" for="form3Example4">Costo: </label>
                        <input type="text" required id="form3Example1" placeholder="$1000" value="{{$servicio->costo}}"
                            class="form-control" name="costo" />
                    </div>
                </div>

                <div>
                    <div style="width: 100%; max-height: 200px;">
                        <img id="vistaPrevia" src="" style="width: 100%; max-height: 200px;">
                    </div>
                    <br>
                    <input class="form-control" type="file" name="imagen" id="imagen">
                    <br><br>
                    <script src="{{ url('assets/js/script.js') }}"></script>
                </div>

                <input value="{{ auth()->user()->id }}" name="id_usuario" hidden>

                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-outline-primary">Editar</button>
                        <button href="/gestionJobs" class="btn btn-outline-danger">Cancelar</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection