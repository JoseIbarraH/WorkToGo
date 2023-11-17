@extends('layouts\app-master')

@section('content')
    <link rel="stylesheet" href="{{ url('assets/css/nav.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/service.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="{{ url('assets/js/script.js') }}"></script>
    @auth
        <br><br>
        <br><br>
        <br><br>

        <body>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 p-1">
                        <h1>Servicios Solicitados</h1>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end p-3">
                        <div style="float: right;" class="ms-auto">
                            <h3>Filtro</h3>
                            <div class="d-flex">
                                <div class="">
                                    <select class="form-select"
                                        style="width: 270px; border-radius: 0% 0% 0% 0%; height: 40px; border-color: rgb(82, 82, 82)"
                                        aria-label="Default select example" name="tipos" id="tipos">
                                        <option value="default" selected>Todos</option>
                                        <option value="Jardineria">Jardineria</option>
                                        <option value="Plomeria">Plomeria</option>
                                        <option value="Fachada">Fachada</option>
                                        <option value="Carpinteria">Carpinteria</option>
                                        <option value="Electronica">Electronica</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                                <button class="sear bi bi-search btn btn-outline-secondary px-2 px-1"
                                    style="border-radius: 0% 20% 20% 0%; font-size: 17px;" onclick="filtro()"
                                    id="filtrar"></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-outline mb-3 mt-4" style="width: 100%;" id="default">
                        <div class="cartas">
                            {{-- @if ($valorSeleccionado = 'default') --}}
                            @foreach ($services as $service)
                                @if($service->estado === 'Activo')
                                <!-- Desde aqui se debe seleccionar para repetir -->
                                <div class="cards col card shadow-sm" style="height: 450px;">
                                    <div class="bd-placeholder-img card-img-top" width="100%" height="225" role="img"
                                        preserveAspectRatio="xMidYMid slice" focusable="false">
                                        <img src="{{ '/storage/assets/img/servicioImagenes/' . $service->id . '.jpg' }}"
                                            height="225px" width="100%">
                                    </div>
                                    <div class="card-body" style="position: relative;">
                                        <h3 class="card-text text-overflow">
                                            <a style="text-decoration: none; color: #161616;">
                                                {{ $service->titulo }}
                                            </a>
                                        </h3>
                                        <div style="font-size: 20px; font-weight: bold;">
                                            Descripcion:
                                        </div>
                                        <div class="text-overflow"
                                            style="overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 3;">
                                            {{ $service->descripcion }}
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center"
                                            style="position: absolute; bottom: 10px; left: 10px;">
                                            <div class="btn-group mt-3">


                                                <div class="row">
                                                    <div class="col-md-6"
                                                        style="width: 250px;>
                                                        <form action="{{ route('showInfo', $service->id) }}"
                                                        method="GET" enctype="multipart/form-data">
                                                        @csrf
                                                        @if (auth()->user()->id === $service->id_usuario)
                                                            <button type="submit" class="btn btn-outline-secondary"
                                                                disabled>Mas
                                                                Informacion</button>
                                                        @elseif (auth()->user()->service === 'Activo')
                                                            <button type="submit" class="btn btn-outline-secondary">Mas
                                                                Informacion</button>
                                                        @else
                                                            <button type="submit" class="btn btn-outline-secondary"
                                                                disabled>Mas
                                                                Informacion</button>
                                                        @endif
                                                        </form>
                                                    </div>
                                                    <div class="col-md-6" style="width: 50px">
                                                        <a class="bi bi-exclamation-circle" style="font-size: 30px"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal"></a>
                                                    </div>
                                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form action="{{route('service.reportar')}}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Reportar
                                                                            servicio
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div style="text-align: center">
                                                                            <h2>Realizar Reporte</h2>
                                                                        </div>
                                                                        <hr>
                                                                        <div>
                                                                            <label for="titulo" class="mt-3">Titulo:
                                                                            </label>
                                                                            <input class="form-control" type="text"
                                                                                name="titulo" id="titulo"
                                                                                placeholder="Titulo">
                                                                        </div>
                                                                        <div>
                                                                            <label for="descripcion" class="mt-3">Descripcion:
                                                                            </label>
                                                                            <textarea class="form-control" name="descripcion" id="descripcion"
                                                                                style="width: 100%; height: 150px; overflow-y: auto; resize: none;" placeholder="Descripcion"></textarea>
                                                                        </div>
                                                                        <input type="text" name="usuario" id="usuario"
                                                                            value="{{ $service->id_usuario }}" hidden>
                                                                        <input type="text" name="servicio" id="servicio"
                                                                            value="{{ $service->id }}" hidden>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Reportar</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- hasta aqui se debe seleccionar para repetir -->
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="form-outline mb-3 mt-4" style="width: 100%;" id="Jardineria" hidden>
                        <div class="cartas">
                            @foreach ($services as $service)
                                @if ($service->tipoServicio === 'Jardineria' && $service->estado === 'Activo')
                                    <!-- Desde aqui se debe seleccionar para repetir -->
                                    <div class="cards col card shadow-sm" style="height: 450px;">
                                        <div class="bd-placeholder-img card-img-top" width="100%" height="225"
                                            role="img" preserveAspectRatio="xMidYMid slice" focusable="false">
                                            <img src="{{ '/storage/assets/img/servicioImagenes/' . $service->id . '.jpg' }}"
                                                height="225px" width="100%">
                                        </div>
                                        <div class="card-body" style="position: relative;">
                                            <h3 class="card-text text-overflow">
                                                <a style="text-decoration: none; color: #161616;">
                                                    {{ $service->titulo }}
                                                </a>
                                            </h3>
                                            <div style="font-size: 20px; font-weight: bold;">
                                                Descripcion:
                                            </div>
                                            <div class="text-overflow"
                                                style="overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 3;">
                                                {{ $service->descripcion }}
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center"
                                                style="position: absolute; bottom: 10px; left: 10px;">
                                                <div class="btn-group mt-3">
                                                    <form action="{{ route('showInfo', $service->id) }}" method="GET"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @if (auth()->user()->id === $service->id_usuario)
                                                            <button type="submit" class="btn btn-outline-secondary"
                                                                disabled>Mas Informacion</button>
                                                        @elseif (auth()->user()->service === 'Activo')
                                                            <button type="submit" class="btn btn-outline-secondary">Mas
                                                                Informacion</button>
                                                        @else
                                                            <button type="submit" class="btn btn-outline-secondary"
                                                                disabled>Mas Informacion</button>
                                                        @endif
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- hasta aqui se debe seleccionar para repetir -->
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="form-outline mb-3 mt-4" style="width: 100%;" id="Plomeria" hidden>
                        <div class="cartas">
                            @foreach ($services as $service)
                                @if ($service->tipoServicio === 'Plomeria' && $service->estado === 'Activo')
                                    <!-- Desde aqui se debe seleccionar para repetir -->
                                    <div class="cards col card shadow-sm" style="height: 450px;">
                                        <div class="bd-placeholder-img card-img-top" width="100%" height="225"
                                            role="img" preserveAspectRatio="xMidYMid slice" focusable="false">
                                            <img src="{{ '/storage/assets/img/servicioImagenes/' . $service->id . '.jpg' }}"
                                                height="225px" width="100%">
                                        </div>
                                        <div class="card-body" style="position: relative;">
                                            <h3 class="card-text text-overflow">
                                                <a style="text-decoration: none; color: #161616;">
                                                    {{ $service->titulo }}
                                                </a>
                                            </h3>
                                            <div style="font-size: 20px; font-weight: bold;">
                                                Descripcion:
                                            </div>
                                            <div class="text-overflow"
                                                style="overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 3;">
                                                {{ $service->descripcion }}
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center"
                                                style="position: absolute; bottom: 10px; left: 10px;">
                                                <div class="btn-group mt-3">
                                                    <form action="{{ route('showInfo', $service->id) }}" method="GET"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @if (auth()->user()->id === $service->id_usuario)
                                                            <button type="submit" class="btn btn-outline-secondary"
                                                                disabled>Mas Informacion</button>
                                                        @elseif (auth()->user()->service === 'Activo')
                                                            <button type="submit" class="btn btn-outline-secondary">Mas
                                                                Informacion</button>
                                                        @else
                                                            <button type="submit" class="btn btn-outline-secondary"
                                                                disabled>Mas Informacion</button>
                                                        @endif
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- hasta aqui se debe seleccionar para repetir -->
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="form-outline mb-3 mt-4" style="width: 100%;" id="Fachada" hidden>
                        <div class="cartas">
                            @foreach ($services as $service)
                                @if ($service->tipoServicio === 'Fachada' && $service->estado === 'Activo')
                                    <!-- Desde aqui se debe seleccionar para repetir -->
                                    <div class="cards col card shadow-sm" style="height: 450px;">
                                        <div class="bd-placeholder-img card-img-top" width="100%" height="225"
                                            role="img" preserveAspectRatio="xMidYMid slice" focusable="false">
                                            <img src="{{ '/storage/assets/img/servicioImagenes/' . $service->id . '.jpg' }}"
                                                height="225px" width="100%">
                                        </div>
                                        <div class="card-body" style="position: relative;">
                                            <h3 class="card-text text-overflow">
                                                <a style="text-decoration: none; color: #161616;">
                                                    {{ $service->titulo }}
                                                </a>
                                            </h3>
                                            <div style="font-size: 20px; font-weight: bold;">
                                                Descripcion:
                                            </div>
                                            <div class="text-overflow"
                                                style="overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 3;">
                                                {{ $service->descripcion }}
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center"
                                                style="position: absolute; bottom: 10px; left: 10px;">
                                                <div class="btn-group mt-3">
                                                    <form action="{{ route('showInfo', $service->id) }}" method="GET"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @if (auth()->user()->id === $service->id_usuario)
                                                            <button type="submit" class="btn btn-outline-secondary"
                                                                disabled>Mas Informacion</button>
                                                        @elseif (auth()->user()->service === 'Activo')
                                                            <button type="submit" class="btn btn-outline-secondary">Mas
                                                                Informacion</button>
                                                        @else
                                                            <button type="submit" class="btn btn-outline-secondary"
                                                                disabled>Mas Informacion</button>
                                                        @endif
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- hasta aqui se debe seleccionar para repetir -->
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="form-outline mb-3 mt-4" style="width: 100%;" id="Carpinteria" hidden>
                        <div class="cartas">
                            @foreach ($services as $service)
                                @if ($service->tipoServicio === 'Carpinteria' && $service->estado === 'Activo')
                                    <!-- Desde aqui se debe seleccionar para repetir -->
                                    <div class="cards col card shadow-sm" style="height: 450px;">
                                        <div class="bd-placeholder-img card-img-top" width="100%" height="225"
                                            role="img" preserveAspectRatio="xMidYMid slice" focusable="false">
                                            <img src="{{ '/storage/assets/img/servicioImagenes/' . $service->id . '.jpg' }}"
                                                height="225px" width="100%">
                                        </div>
                                        <div class="card-body" style="position: relative;">
                                            <h3 class="card-text text-overflow">
                                                <a style="text-decoration: none; color: #161616;">
                                                    {{ $service->titulo }}
                                                </a>
                                            </h3>
                                            <div style="font-size: 20px; font-weight: bold;">
                                                Descripcion:
                                            </div>
                                            <div class="text-overflow"
                                                style="overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 3;">
                                                {{ $service->descripcion }}
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center"
                                                style="position: absolute; bottom: 10px; left: 10px;">
                                                <div class="btn-group mt-3">
                                                    <form action="{{ route('showInfo', $service->id) }}" method="GET"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @if (auth()->user()->id === $service->id_usuario)
                                                            <button type="submit" class="btn btn-outline-secondary"
                                                                disabled>Mas Informacion</button>
                                                        @elseif (auth()->user()->service === 'Activo')
                                                            <button type="submit" class="btn btn-outline-secondary">Mas
                                                                Informacion</button>
                                                        @else
                                                            <button type="submit" class="btn btn-outline-secondary"
                                                                disabled>Mas Informacion</button>
                                                        @endif
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- hasta aqui se debe seleccionar para repetir -->
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="form-outline mb-3 mt-4" style="width: 100%;" id="Electronica" hidden>
                        <div class="cartas">
                            @foreach ($services as $service)
                                @if ($service->tipoServicio === 'Electronica' && $service->estado === 'Activo')
                                    <!-- Desde aqui se debe seleccionar para repetir -->
                                    <div class="cards col card shadow-sm" style="height: 450px;">
                                        <div class="bd-placeholder-img card-img-top" width="100%" height="225"
                                            role="img" preserveAspectRatio="xMidYMid slice" focusable="false">
                                            <img src="{{ '/storage/assets/img/servicioImagenes/' . $service->id . '.jpg' }}"
                                                height="225px" width="100%">
                                        </div>
                                        <div class="card-body" style="position: relative;">
                                            <h3 class="card-text text-overflow">
                                                <a style="text-decoration: none; color: #161616;">
                                                    {{ $service->titulo }}
                                                </a>
                                            </h3>
                                            <div style="font-size: 20px; font-weight: bold;">
                                                Descripcion:
                                            </div>
                                            <div class="text-overflow"
                                                style="overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 3;">
                                                {{ $service->descripcion }}
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center"
                                                style="position: absolute; bottom: 10px; left: 10px;">
                                                <div class="btn-group mt-3">
                                                    <form action="{{ route('showInfo', $service->id) }}" method="GET"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @if (auth()->user()->id === $service->id_usuario)
                                                            <button type="submit" class="btn btn-outline-secondary"
                                                                disabled>Mas Informacion</button>
                                                        @elseif (auth()->user()->service === 'Activo')
                                                            <button type="submit" class="btn btn-outline-secondary">Mas
                                                                Informacion</button>
                                                        @else
                                                            <button type="submit" class="btn btn-outline-secondary"
                                                                disabled>Mas Informacion</button>
                                                        @endif
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- hasta aqui se debe seleccionar para repetir -->
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="form-outline mb-3 mt-4" style="width: 100%;" id="Otro" hidden>
                        <div class="cartas">
                            @foreach ($services as $service)
                                @if ($service->tipoServicio === 'Otro' && $service->estado === 'Activo')
                                    <!-- Desde aqui se debe seleccionar para repetir -->
                                    <div class="cards col card shadow-sm" style="height: 450px;">
                                        <div class="bd-placeholder-img card-img-top" width="100%" height="225"
                                            role="img" preserveAspectRatio="xMidYMid slice" focusable="false">
                                            <img src="{{ '/storage/assets/img/servicioImagenes/' . $service->id . '.jpg' }}"
                                                height="225px" width="100%">
                                        </div>
                                        <div class="card-body" style="position: relative;">
                                            <h3 class="card-text text-overflow">
                                                <a style="text-decoration: none; color: #161616;">
                                                    {{ $service->titulo }}
                                                </a>
                                            </h3>
                                            <div style="font-size: 20px; font-weight: bold;">
                                                Descripcion:
                                            </div>
                                            <div class="text-overflow"
                                                style="overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 3;">
                                                {{ $service->descripcion }}
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center"
                                                style="position: absolute; bottom: 10px; left: 10px;">
                                                <div class="btn-group mt-3">
                                                    <form action="{{ route('showInfo', $service->id) }}" method="GET"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @if (auth()->user()->id === $service->id_usuario)
                                                            <button type="submit" class="btn btn-outline-secondary"
                                                                disabled>Mas Informacion</button>
                                                        @elseif (auth()->user()->service === 'Activo')
                                                            <button type="submit" class="btn btn-outline-secondary">Mas
                                                                Informacion</button>
                                                        @else
                                                            <button type="submit" class="btn btn-outline-secondary"
                                                                disabled>Mas Informacion</button>
                                                        @endif
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- hasta aqui se debe seleccionar para repetir -->
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </body>
    @endauth

    @guest

        para ver el contenido <a href="/login">Inicia seccion</a>
    @endguest
@endsection
