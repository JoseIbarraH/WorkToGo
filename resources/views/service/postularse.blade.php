@extends('layouts\app-master')

@section('content')
    <link rel="stylesheet" href="{{ url('assets/css/nav.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/home.css') }}">
    @auth
        <br><br><br>
        <br><br><br>
        <div>

            <div class="row">
                <div class="col-md-6 mt-5" style="width: 60%">
                    <form action="{{ route('postular', $servicio->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h1>Informacion Del Servicio Seleccionado</h1>
                        <hr>
                        <div class="mt-4">
                            <h2>{{ $servicio->titulo }}</h2>
                        </div>
                        <div class="mt-5">
                            <h2>Descripcion: </h2>
                            <div style="width: 100%; height: 150px; max-height: 150px; overflow-y: auto;">
                                <h4 class="">{{ $servicio->descripcion }}</h4>
                            </div>
                        </div>
                        <div style="display: flex">
                            <div>
                                <h2>Precio:</h2>
                                <div style="width: auto; display: flex;">
                                    <input class="form-control" style="width: auto;" type="text" name="costo"
                                        value="${{ $servicio->costo }}" readonly>
                                    <div>
                                        <input type="checkbox" onclick="check()" style="width: 25px; height: 25px;"
                                            class="form-check-input mx-2" name="precio" id="precio" value="Sugerir Precio">
                                    </div>
                                </div>
                            </div>
                            <div id="tex" class="mt-5">
                                <h4>Selecciona si deseas negociar el precio</h4>
                            </div>
                            <div id="sugerido" hidden>
                                <h2>Precio Sugerido:</h2>
                                <div style="width: auto; display: flex;">
                                    <input class="form-control" style="width: auto;" type="text" name="costo" id="costo"
                                        placeholder="$1000">
                                </div>
                            </div>
                        </div>
                        <div style="display: flex" class="mt-4">
                            <div>
                                <input type="checkbox" style="width: 25px; height: 25px;" class="form-check-input mx-2"
                                    name="termino" id="termino" onclick="terminos()" value="Sugerir Precio">
                            </div>
                            <div id="tex">
                                <a data-bs-toggle="modal" data-bs-target="#termsModal">
                                    <h4>Terminos y condiciones</h4>
                                </a>
                                <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Términos y Condiciones</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Your terms and conditions content goes here -->
                                                <p>

                                                    1. Relación Laboral: <br>
                                                    Al aceptar este trabajo, el empleado reconoce y acepta que su relación con
                                                    la empresa es de carácter laboral y estará sujeta a las leyes y regulaciones
                                                    laborales aplicables. <br>

                                                    2. Obligaciones del Empleado:<br>
                                                    El empleado se compromete a desempeñar sus funciones con diligencia, ética y
                                                    profesionalismo. Debe seguir todas las políticas internas de la empresa y
                                                    cumplir con las responsabilidades asignadas.<br>

                                                    3. Confidencialidad:<br>
                                                    El empleado acuerda mantener la confidencialidad de la información sensible
                                                    de la empresa, incluyendo, pero no limitándose a, datos de clientes,
                                                    estrategias comerciales y cualquier otro tipo de información
                                                    confidencial.<br>

                                                    4. Remuneración y Beneficios:<br>
                                                    Los detalles sobre salario, bonificaciones, beneficios y cualquier
                                                    compensación adicional se establecerán en un acuerdo por separado o en el
                                                    contrato de trabajo.<br>

                                                    5. Duración del Empleo:<br>
                                                    La duración del empleo puede ser especificada en el contrato de trabajo. La
                                                    empresa se reserva el derecho de terminar la relación laboral por motivos
                                                    justificados, de acuerdo con las leyes aplicables.<br>

                                                    6. Propiedad Intelectual:<br>
                                                    Cualquier creación intelectual desarrollada por el empleado en el curso de
                                                    su empleo pertenecerá a la empresa, a menos que se acuerde lo contrario por
                                                    escrito.<br>

                                                    7. Rescisión y Aviso:<br>
                                                    Ambas partes acuerdan seguir los procedimientos de rescisión y aviso
                                                    establecidos por las leyes laborales aplicables. Cualquier parte puede dar
                                                    por terminada la relación laboral de acuerdo con estos procedimientos.<br>

                                                    8. Modificaciones de Términos y Condiciones:<br>
                                                    La empresa se reserva el derecho de modificar estos términos y condiciones,
                                                    y cualquier cambio será notificado al empleado con anticipación.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <!-- Add any additional buttons as needed -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" id="posta" class="btn btn-primary" disabled>Postularse</button>
                    </form>
                </div>
                <div class="col-md-6  p-3 mb-4 mx-auto imgcaptu " style="width: 450px;">
                    <div class="card p-2" style="width: 100%">
                        <div class="d-flex flex-column justify-content-center align-items-center" style="">
                            <div style="width: 100%; max-height: 250px; height: 250px;">
                                <img id="vistaPrevia"
                                    src="{{ '/storage/assets/img/servicioImagenes/' . $servicio->id . '.jpg' }}"
                                    style="width: 100%; max-height: 250px;">
                            </div>
                        </div>
                    </div>
                    <div class="mt-5" style="display: flex">
                        <img src="{{ asset('/storage/assets/img/perfilImagenes/' . $servicio->id_usuario . '.jpg') }}"
                            alt="" width="60" height="60" class="rounded-circle me-2">
                        <h3 class="mt-2 mx-2">{{ $usuario->nombre }}</h3>
                    </div>

                </div>
            </div>
        </div>
        <script src="{{ url('assets/js/script.js') }}"></script>
    @endauth

    @guest
        <br><br><br><br>
        para ver el contenido <a href="/login">Inicia seccion</a>
    @endguest
@endsection










