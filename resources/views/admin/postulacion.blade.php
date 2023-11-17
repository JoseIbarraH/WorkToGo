@extends('layouts\app-master-4')

@section('content')
    @auth
        <br><br>
        <div>
            <h1 class="mb-5">Lista De Postulaciones</h1>
            @foreach ($results as $result)
                <div class="accordion mt-2" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne{{ $result->id_usuario }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne{{ $result->id_usuario }}" aria-expanded="false"
                                aria-controls="flush-collapseOne{{ $result->id_usuario }}">
                                <h5>Postulacion: {{ $result->nombre }}</h5>
                            </button>
                        </h2>
                        <div id="flush-collapseOne{{ $result->id_usuario }}" class="accordion-collapse collapse"
                            aria-labelledby="flush-headingOne{{ $result->id_usuario }}" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <h2>Imagenes de servicios realizados</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div style="display: flex">
                                            @for ($i = 1; $i <= 10; $i++)
                                                @php
                                                    $rutaArchivo = storage_path("app/public/assets/img/postulacion/{$result->id_usuario}/imgtest/{$i}.jpg");
                                                @endphp
                                                @if (File::exists($rutaArchivo))
                                                    <img src="{{ asset('/storage/assets/img/postulacion/' . $result->id_usuario . '/imgtest/' . $i . '.jpg') }}"
                                                        alt="" width="200px" height="150px">
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h3>Estado: </h3>
                                                <h4 style="color: rgb(153, 255, 0)">{{ $result->estado }}</h4>
                                            </div>
                                            <div class="col-md-6" style="float: right;">
                                                <div style="display: flex">


                                                    <div>
                                                        <button type="button" class="btn btn-primary mx-2"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal{{ $result->id_usuario }}">
                                                            Aceptar
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal{{ $result->id_usuario }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Aceptar
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div style="width: 100%; text-align: center">
                                                                            <a class="bi bi-exclamation-circle"
                                                                                style="width: 100%; font-size: 100px; color: rgb(238, 255, 0)(238, 255, 0)"></a>
                                                                        </div>
                                                                        <div style="width: 100%">
                                                                            <h2 style="width: 100%; text-align: center">¿seguro
                                                                                que desea aceptar esta solicitud?</h2>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <form action="{{ route('admin.aceptar') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <div class="mx-1">
                                                                                <input type="text" id="usuario"
                                                                                    name="usuario" hidden
                                                                                    value="{{ $result->id_usuario }}">
                                                                                <button class="btn btn-primary">Aceptar</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div>
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalasd{{ $result->id_usuario }}">
                                                            Denegar
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModalasd{{ $result->id_usuario }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Denegar
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div style="width: 100%; text-align: center">
                                                                            <a class="bi bi-exclamation-circle"
                                                                                style="width: 100%; font-size: 100px; color: red"></a>
                                                                        </div>
                                                                        <div style="width: 100%">
                                                                            <h2 style="width: 100%; text-align: center">¿seguro
                                                                                que desea denegar esta solicitud?</h2>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <form action="{{ route('admin.delete') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('delete')
                                                                            <input type="text" id="usuario" name="usuario"
                                                                                hidden value="{{ $result->id_usuario }}">
                                                                            <button class="btn btn-danger"
                                                                                type="submit">Denegar</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="mt-2">Detalles de trabajos anteriores</h3>
                                        <textarea name="detalles" id="detalles" class="form-control" style="width: 100%; height: 100px; overflow-y: auto"
                                            readonly>{{ $result->proyectos }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="mt-2">Detalles del servicio</h3>
                                        <textarea name="detalles" id="detalles" class="form-control" style="width: 100%; height: 100px; overflow-y: auto"
                                            readonly>{{ $result->tipo }}</textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endauth
@endsection
