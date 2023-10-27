@extends('layouts\app-master-2')
@section('content')
    <br>

    <body>
        <div class="container">
            <div class="row">
                <div class="izquierda col-2" style="width: 40%; height: auto;">
                    <div class="card p-3 mb-4" style="width: 450px">
                        <div class="card-text">
                            <h1 class="p-3" style="text-align: center">Gestionar Servicios</h1>
                            <hr>
                        </div>
                        <form action="/gestionJobs" method="POST" enctype="multipart/form-data">

                            @csrf
                            <div>

                                <!-- Titulo del trabajo-->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label" for="form3Example1">Titulo: </label>
                                        <input type="text" required id="form3Example1" placeholder="Titulo del trabajo"
                                            class="form-control" name="titulo" />
                                    </div>
                                    <!-- tipos de trabajos-->
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label" for="form3Example1">Tipos De Trabajos: </label>
                                        <select class="form-select" required aria-label="Default select example"
                                            name="tipoServicio">
                                            <option selected disabled>Tipos De Trabajos</option>
                                            <option value="Jardineria">Jardineria</option>
                                            <option value="Plomeria">Plomeria</option>
                                            <option value="Fachada">Fachada</option>
                                            <option value="Carpinteria">Carpinteria</option>
                                            <option value="Electronica">Electronica</option>
                                            <option value="Otro">Otro</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Descripcion del trabajo -->
                                <div class="form-outline mb-3">
                                    <label class="form-label" for="form3Example4">Descripcion: </label>
                                    <textarea name="descripcion" required class="form-control" style="width: 100%; height: 100px;"
                                        placeholder="Descripcion del trabajo"></textarea>
                                </div>

                                <!-- Costo del trabajo -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label" for="form3Example4">Costo: </label>
                                        <input type="text" required id="form3Example1" placeholder="$1000"
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
                                        <button type="submit" class="btn btn-outline-success">Agregar</button>
                                        <button type="reset" class="btn btn-outline-danger">Cancelar</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="derecha col-10" style="width: 60%;">
                    <div style="width:auto; height: 650px; overflow-y: auto; overflow-x: hidden">
                        <table class="table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Titulo</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Costo</th>
                                    <th scope="col" style="text-align: center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <div hidden>{{ $auto = 1 }}</div>
                                @foreach ($services as $service)
                                    @if ($service->id_usuario == auth()->user()->id)
                                        <tr>
                                            <td>{{ $auto }}</td>
                                            <td
                                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px;">
                                                {{ $service->titulo }}</td>
                                            <td
                                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px;">
                                                {{ $service->descripcion }}</td>
                                            <td>{{ $service->tipoServicio }}</td>
                                            <td>${{ $service->costo }}</td>
                                            <td>
                                                <div class="row" style="display: flex;">
                                                    <div class="col-6" style="width: auto">
                                                        <form method="GET"
                                                            action="/gestionJobs/{{ $service->id }}/editar">
                                                            @csrf <!-- Asegúrate de incluir el token CSRF -->
                                                            <button type="submit" class="btn btn-primary">Editar</button>
                                                        </form>
                                                    </div>
                                                    <div class="col-6" style="width: auto">
                                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#mi-modal">Eliminar</button>

                                                        <div class="modal" id="mi-modal">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">

                                                                    <div class="modal-header"
                                                                        style="width: 100%; text-align: center;">
                                                                        <h2>Eliminar</h2>

                                                                    </div>

                                                                    <div class="modal-body" style="align-content: center">
                                                                        <div style="width: 100%; text-align: center">
                                                                            <a class="bi bi-lg bi-x-octagon" style="color: red; text-align: center; font-size: 90px"></a>
                                                                        </div>
                                                                        
                                                                        <div style="width: 100%;">
                                                                            <h4 style="text-align: center">Estas seguro de eliminar este servicio?</h4>
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-primary" href="/gestionJobs" data-bs-dismiss="modal">Cancelar</button>
                                                                        <form
                                                                            action="{{ route('gestionarJobs.destroy', $service) }}" method="POST">
                                                                            @csrf
                                                                            @method('delete')
                                                                            <button class="btn btn-danger">Eliminar</button>
                                                                        </form>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </td>
                                            <div hidden>{{ $auto = $auto + 1 }}</div>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </body>
@endsection
