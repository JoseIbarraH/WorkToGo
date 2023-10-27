@extends('layouts\app-master')

@section('content')
    <link rel="stylesheet" href="{{ url('assets/css/nav.css') }}">

    @auth
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
                            <select class="form-select" style="width: 300px;" aria-label="Default select example" name="tipos"
                                id="tipos">
                                <option selected disabled>Filtro Por Tipos De Trabajos</option>
                                <option value="Jardineria">Jardineria</option>
                                <option value="Plomeria">Plomeria</option>
                                <option value="Fachada">Fachada</option>
                                <option value="Carpinteria">Carpinteria</option>
                                <option value="Electronica">Electronica</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-outline mb-3 mt-4" style="width: 100%;">
                        <div class="cartas"
                            style="display: grid; grid-gap: 1rem; grid-template-columns: 25% 25% 25% 25%; grid-template-rows: auto auto;">
                            @foreach ($services as $service)
                                <!-- Desde aqui se debe seleccionar para repetir -->
                                <div class="cards col card shadow-sm" style="height: 450px;">
                                    <div class="bd-placeholder-img card-img-top" width="100%" height="225" role="img"
                                        preserveAspectRatio="xMidYMid slice" focusable="false">
                                        <img src="{{ '/storage/assets/img/servicioImagenes/' . $service->id . '.jpg' }}"
                                            height="225px" width="100%">
                                    </div>
                                    <div class="card-body" style="position: relative;">
                                        <h3 class="card-text text-overflow"><a
                                                style="text-decoration: none; color: #161616;">{{ $service->titulo }}</a></h3>
                                        <div style="font-size: 20px; font-weight: bold;">Descripcion:</div>
                                        <div class="text-overflow"
                                            style="overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 3;">
                                            {{ $service->descripcion }}</div>
                                        <div class="d-flex justify-content-between align-items-center"
                                            style="position: absolute; bottom: 10px; left: 10px;">
                                            <div class="btn-group mt-3">
                                                <button type="button" disabled
                                                    class="btn btn-sm btn-outline-secondary">Informacion</button>
                                                @if (auth()->user()->service == 'Activo')
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-secondary">Solicitar</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- hasta aqui se debe seleccionar para repetir -->
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
