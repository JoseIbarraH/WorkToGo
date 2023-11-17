@extends('layouts\app-master-2')

@section('content')
    <link rel="stylesheet" href="{{ url('assets/css/nav.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/perfil.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/tarjeta.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Lato|Liu+Jian+Mao+Cao&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    @auth
        <style>
            .trasera {
                background: url('{{ asset('assets/img/image/bg-tarjeta-01.jpg') }}');
                background-size: cover;
                position: absolute;
                top: 0;
                transform: rotateY(180deg);
                backface-visibility: hidden;
            }

            .tarjeta .delantera {
                width: 100%;
                background: url('{{ asset('assets/img/image/bg-tarjeta-02.jpg') }}');
                background-size: cover;
            }
        </style>


        <br><br><br><br><br><br>
        <h1>Perfil De Usuario</h1>
        <form action="{{ route('actualizacion') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6 mt-5" style="display: flex; justify-content: center; align-items: center; width: 500px;">
                    <div class="">
                        <div style="display: flex; justify-content: center; align-items: center;">
                            <img src="{{ asset('/storage/assets/img/perfilImagenes/' . auth()->user()->id . '.jpg') }}"
                                alt="" width="150" height="150" class="rounded-circle ">
                        </div>
                        <input class="form-control mt-3" type="file" name="imagen" id="imagen">
                    </div>
                </div>
                <div class="col-md-6 mb-4" style="width: 740px;">
                    <div class="row">
                        <div class="col-md-6 mt-5">

                            <div class="row" style="min-width: 360px;">
                                <div class="col-6" style="width: 280px">
                                    <span>Cedula: </span>
                                    <input type="text" class="form-control" id="firstName" name="cedula"
                                        value="{{ auth()->user()->cedula }}" readonly required>
                                </div>
                            </div>

                            <div class="row mt-3" style="min-width: 360px;">
                                <div class="col-6" style="width: 280px">
                                    <span>Nombre: </span>
                                    <input type="text" class="form-control" id="nombre2" name="nombre"
                                        value="{{ auth()->user()->nombre }}" readonly required>
                                </div>
                                <div class="col-6 mt-4 p-0" style="width: 40px;">
                                    <button type="button" id="nombre" onclick="habilitarInput2()"
                                        class="bi bi-pencil-square btn btn-outline-secondary p-0"
                                        style="width: 100%; height: 38px; border-radius: 20px; font-size: 20px"></button>
                                </div>
                            </div>

                            <div class="row mt-3 card p-2" style="min-width: 360px;">
                                <div class="col-6" style="width: 100%">
                                    <span>Contraseña Actual: </span>
                                    <input type="password" class="form-control" id="firstName" name="password_actual">
                                </div>
                                <div class="col-6" style="width: 100%">
                                    <span>Contraseña Nueva: </span>
                                    <input type="password" class="form-control" id="firstName" name="password_nueva">
                                </div>
                                <div class="col-6" style="width: 100%">
                                    <span>Confirmar Contraseña : </span>
                                    <input type="password" class="form-control" id="firstName" name="password_confirmar">
                                </div>
                            </div>



                        </div>

                        <div class="col-md-6 mt-5">
                            <div class="row" style="min-width: 360px;">
                                <div class="col-6" style="width: 280px">
                                    <span>Email: </span>
                                    <input type="email" class="form-control" id="firstName" name="email"
                                        value="{{ auth()->user()->email }}" readonly required>
                                </div>
                            </div>

                            <div class="row mt-3" style="min-width: 360px;">
                                <div class="col-6" style="width: 280px">
                                    <span>Username: </span>
                                    <input type="text" class="form-control" id="username2" name="username"
                                        value="{{ auth()->user()->username }}" readonly required>
                                </div>
                                <div class="col-6 mt-4 p-0" style="width: 40px;">
                                    <button type="button" onclick="habilitarInput()" id="username"
                                        class="bi bi-pencil-square btn btn-outline-secondary p-0"
                                        style="width: 100%; height: 38px; border-radius: 20px; font-size: 20px"></button>
                                </div>
                            </div>

                            <div class="row mt-3" style="min-width: 360px;">
                                <div class="col-6" style="width: 280px">
                                    <span>Telefono: </span>
                                    <input type="text" class="form-control" id="telefono2" name="celular"
                                        value="{{ auth()->user()->celular }}" readonly required>
                                </div>
                                <div class="col-6 mt-4 p-0" style="width: 40px;">
                                    <button type="button" onclick="habilitarInput3()" id="telefono"
                                        class="bi bi-pencil-square btn btn-outline-secondary p-0"
                                        style="width: 100%; height: 38px; border-radius: 20px; font-size: 20px"></button>
                                </div>
                            </div>


                        </div>
                        <!-- Boton Actualizar -->
                        <div class="mt-3">

                            <input type="submit" onclick="deshabilitarInput()" class="btn btn-primary" value="Actualizar"
                                id="update">

                        </div>
                    </div>
                </div>
            </div>
        </form>
        <hr>
        <div class="row">
            <div style="text-align: center">
                <h2>Agregar nuevo metodo de pago</h2>
            </div>
            <div class="col-md-6" style="width: 500px; height: 300px;">
                <div class="p-3">
                    <div class="mt-3">
                        <div class="contenedor " style="width: 450px; height: 300px;" >
                            <!-- Tarjeta -->
                            <section class="tarjeta" id="tarjeta">
                                <div class="delantera">
                                    <div class="logo-marca" id="logo-marca">
                                        <!-- <img src="img/logos/visa.png" alt=""> -->
                                    </div>
                                    <img src="{{ asset('assets/img/image/chip-tarjeta.png') }}" class="chip"
                                        alt="">
                                    <div class="datos">
                                        <div class="grupo" id="numero">
                                            <p class="label">Número Tarjeta</p>
                                            <p class="numero">#### #### #### ####</p>
                                        </div>
                                        <div class="flexbox">
                                            <div class="grupo" id="nombre">
                                                <p class="label">Nombre Tarjeta</p>
                                                <p class="nombre">Jhon Doe</p>
                                            </div>
                                            <div class="grupo" id="expiracion">
                                                <p class="label">Expiracion</p>
                                                <p class="expiracion"><span class="mes">MM</span> / <span
                                                        class="year">AA</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="trasera">
                                    <div class="barra-magnetica"></div>
                                    <div class="datos">
                                        <div class="grupo" id="firma">
                                            <p class="label">Firma</p>
                                            <div class="firma">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="grupo" id="ccv">
                                            <p class="label">CCV</p>
                                            <p class="ccv"></p>
                                        </div>
                                    </div>
                                    <p class="leyenda">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus
                                        exercitationem, voluptates illo.</p>
                                    <a href="#" class="link-banco">www.tubanco.com</a>
                                </div>
                            </section>
                            <!-- Contenedor Boton Abrir Formulario -->
                            <div class="contenedor-btn">
                                <button class="btn-abrir-formulario" id="btn-abrir-formulario">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <!-- Formulario -->
                            <form action="{{ route('nuevoMetodoPago') }}" method="POST" enctype="multipart/form-data"
                                id="formulario-tarjeta" class="formulario-tarjeta"
                                style="border: 2px solid rgb(132, 132, 132);">
                                @csrf
                                <div class="grupo">
                                    <label for="inputNumero">Número Tarjeta</label>
                                    <input type="text" id="inputNumero" name="inputNumero" maxlength="19"
                                        autocomplete="off">
                                </div>
                                <div class="grupo">
                                    <label for="inputNombre">Nombre</label>
                                    <input type="text" id="inputNombre" name="inputNombre" maxlength="19"
                                        autocomplete="off">
                                </div>
                                <div class="flexbox">
                                    <div class="grupo expira">
                                        <label for="selectMes">Expiracion</label>
                                        <div class="flexbox">
                                            <div class="grupo-select">
                                                <select name="mes" id="selectMes">
                                                    <option disabled selected>Mes</option>
                                                </select>
                                                <i class="fas fa-angle-down"></i>
                                            </div>
                                            <div class="grupo-select">
                                                <select name="year" id="selectYear">
                                                    <option disabled selected>Año</option>
                                                </select>
                                                <i class="fas fa-angle-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grupo ccv">
                                        <label for="inputCCV">CCV</label>
                                        <input type="text" id="inputCCV" name="inputCCV" placeholder="CCV"
                                            maxlength="3">
                                    </div>
                                </div>
                                <button type="submit" class="btn-enviar">Enviar</button>
                            </form>
                        </div>
                        <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="width: 800px">
                <div hidden>{{ $n1 = 0 }}</div>
                @foreach ($metodo as $metodos)
                    @if ($metodos->id_usuario === auth()->user()->id)
                        <div class="card mt-3 p-3" style="width: 100%">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            @if (substr($metodos->numeroTarjeta, 0, 1) === '5')
                                                <img src="{{ asset('assets/img/image/mastercard.png') }}" class="chip"
                                                    alt="" style="width: 100px">
                                            @elseif (substr($metodos->numeroTarjeta, 0, 1) === '4')
                                                <img src="{{ asset('assets/img/image/visapng.png') }}" class="chip"
                                                    alt=""
                                                    style="width: 100px; filter: brightness(1.1); mix-blend-mode: multiply;">
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <h4>Nombre Titular</h4>
                                            <h5>{{ $metodos->nombreTitular }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" >
                                    <div class="row">
                                        <div class="col-md-6" style="width: 290px">
                                            <h4>Numero de Cuenta</h4>
                                            <div class="numero-container">
                                                <h5 id="numero{{ $n1 }}" name="numero">
                                                    {{ $metodos->numeroTarjeta }}</h5>
                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        // Obtén el elemento h5 que contiene el número de tarjeta
                                                        var numeroElement = document.getElementById('numero{{ $n1 }}');

                                                        // Obtén el contenido del número de tarjeta
                                                        var numeroCompleto = numeroElement.textContent.trim();

                                                        // Oculta todos los dígitos excepto los últimos cuatro
                                                        var numeroOculto = '*'.repeat(numeroCompleto.length - 4) + numeroCompleto.slice(-4);

                                                        // Establece el contenido del elemento con el número oculto
                                                        numeroElement.textContent = numeroOculto;
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="width: 86px">
                                            <form action="{{route('deleteTarjeta', $metodos)}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <input type="submit" value="Eliminar" class="btn btn-danger mt-3"
                                                style="float: right">
                                            </form>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                        <div hidden>{{ $n1 = $n1 + 1 }}</div>
                    @endif
                @endforeach
            </div>
        </div>
        
        <script src="{{ url('assets/js/tarjeta.js') }}"></script>
        <script src="{{ url('assets/js/script.js') }}"></script>
    @endauth

    @guest
        para ver el contenido <a href="/login">Inicia seccion</a>
    @endguest
@endsection
