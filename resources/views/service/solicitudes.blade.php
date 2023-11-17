@extends('layouts\app-master-3')
<link rel="stylesheet" href="{{ url('assets/css/historial.css') }}">

@section('content')
    <br><br>
    <div>
        <h1>Historial de solicitudes</h1>
        <div hidden>{{ $na = 1 }}</div>
        @foreach ($services as $servicio)
            @if (
                ($servicio->estado === 'Activo' || $servicio->estado === 'Pendiente') &&
                    $servicio->id_usuario === auth()->user()->id)
                <div class="accordion mt-3" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne{{ $na }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne{{ $na }}" aria-expanded="false"
                                aria-controls="collapseOne">
                                <div hidden>{{ $nu = 0 }}</div>
                                @foreach ($result as $results)
                                    @if ($servicio->id === $results->id_servicio)
                                        <div hidden>{{ $nu = $nu + 1 }}</div>
                                    @endif
                                @endforeach
                                <h4>{{ $servicio->titulo }}</h4>
                                @if ($servicio->estado === 'Activo')
                                    <div class=""
                                        style="width: 30px; height: 30px; border-radius: 20px; background-color: rgb(255, 55, 55); text-align: center;">
                                        <h4 class="m-0" style="color: blanchedalmond">{{ $nu }}</h4>
                                    </div>
                                @elseif($servicio->estado === 'Pendiente')
                                    <div style="width: 300px; display: flex;">
                                        <h4 style="color: orange">&nbsp;&nbsp;&nbsp;{{ $servicio->estado }}</h4>
                                    </div>
                                @endif
                            </button>
                        </h2>
                        <div id="collapseOne{{ $na }}" class="accordion-collapse collapse "
                            aria-labelledby="headingOne{{ $na }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div hidden>{{ $nab = 1 }}</div>
                                @foreach ($result as $results)
                                    @if ($servicio->id === $results->id_servicio && $results->estado === 'Activo' && $servicio->estado === 'Activo')
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
                                                                    <h4>No se ha sugerido un precio</h4>
                                                                    <h5>${{ $results->costo }}</h5>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <h4>Telefono</h4>
                                                                        <h5>{{ $results->celular }}</h5>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        @if ($servicio->estado === 'Activo')
                                                                            <form
                                                                                action="{{ route('gestionJobs.aceptar', ['id' => $servicio->id, 'CodigoTrabajador' => $results->CodigoTrabajador]) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <input type="submit"
                                                                                    class="btn btn-primary" value="Aceptar"
                                                                                    name="aceptar" id="aceptar">
                                                                            </form>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($servicio->id === $results->id_servicio && $results->estado === 'Pendiente' && $servicio->estado === 'Pendiente')
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
                                                                    <h4>No se ha sugerido un precio</h4>
                                                                    <h5>${{ $results->costo }}</h5>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <h4>Telefono</h4>
                                                                        <h5>{{ $results->celular }}</h5>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        @if ($servicio->estado === 'Pendiente')
                                                                            <form
                                                                                action="{{ route('gestionJobs.terminar', ['id' => $servicio->id, 'CodigoTrabajador' => $results->CodigoTrabajador]) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                @method('put')
                                                                                <input type="submit" value="Terminar"
                                                                                    class="btn btn-warning">
                                                                            </form>
                                                                        @endif
                                                                    </div>
                                                                </div>
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
@endsection
