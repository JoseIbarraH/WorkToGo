@extends('layouts\app-master-2')

@section('content')
    <link rel="stylesheet" href="{{ url('assets/css/nav.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/perfil.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @auth
        <br><br><br><br><br><br>
        <div>
            <h1>Historial De Servicios Solicitados</h1>
            <div hidden>{{ $na = 1 }}</div>
            @foreach ($services as $servicio)
                @if (
                    ($servicio->estado === 'Inactivo') &&
                        $servicio->id_usuario === auth()->user()->id)
                    <div class="accordion mt-3" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne{{ $na }}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne{{ $na }}" aria-expanded="false"
                                    aria-controls="collapseOne">
                                    <div hidden>{{ $nu = 0 }}</div>
                                    @foreach ($result as $results)
                                        @if ($results === 'Inactivo')
                                            <div hidden>{{ $nu = $nu + 1 }}</div>
                                        @endif
                                    @endforeach
                                    <h4>{{ $servicio->titulo }}</h4>
                                </button>
                            </h2>
                            <div id="collapseOne{{ $na }}" class="accordion-collapse collapse "
                                aria-labelledby="headingOne{{ $na }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div hidden>{{ $nab = 1 }}</div>
                                    @foreach ($result as $results)
                                        @if ($servicio->id === $results->id_servicio && $results->estado === 'Inactivo' && $servicio->estado === 'Inactivo')
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="heading{{ $nab }}a">
                                                        <button class="accordion-button" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapse{{ $nab }}a"
                                                            aria-expanded="false" aria-controls="collapseOne">
                                                            <img src="{{ asset('/storage/assets/img/perfilImagenes/' . $results->id_usuario . '.jpg') }}"
                                                                alt="" width="32" height="32"
                                                                class="rounded-circle me-2">
                                                            {{ $results->nombre }}
                                                        </button>
                                                    </h2>
                                                    <div id="collapse{{ $nab }}a" class="accordion-collapse collapse"
                                                        aria-labelledby="heading{{ $nab }}a"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    @if ($results->sugerido)
                                                                        <h4>Precio sugerido</h4>
                                                                        <h5>${{ $results->sugerido }}</h5>
                                                                    @else
                                                                        <h4>No se ha sugirio un precio</h4>
                                                                        <h5>${{ $results->costo }}</h5>
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h4>Telefono</h4>
                                                                    <h5>{{ $results->celular }}</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div hidden>{{ $nab = $nab + 1 }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div hidden>{{ $na = $na + 1 }}</div>
            @endforeach

        </div>
    @endauth

    @guest
        <br><br><br><br>
        para ver el contenido <a href="/login">Inicia seccion</a>
    @endguest
@endsection
