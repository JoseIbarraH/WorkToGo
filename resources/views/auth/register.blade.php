<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
</head>

<body>
    <section class="">
        <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <img src="{{ asset('assets/img/aea.png') }}" alt="worktgo" class="img-fluid"
                            style="width: 500px;" />
                        <h1 class="my-5 display-3 fw-bold ls-tight">La mejor Oferta</h1> <br />
                        <span class="text-primary">Para tus empleos</span>
                        <p style="color: hsl(217, 10%, 50.8%)">
                            Registrate para continuar y si ya tienes cuenta inicia seccion:
                            <a href="/login" style="color: #393f81;text-decoration: none;"> Iniciar seccion </a>
                        </p>
                    </div>
                    <div class="col-lg-6 mb-3 mb-lg-0">
                        <div class="card">
                            <div class="card-body py-3 px-md-3">
                                <form action="/register" method="POST">
                                    @csrf
                                    @include('layouts\partials\message')
                                    <h1 style="text-align: center;">Registrarse</h1>
                                    <!-- Email input -->
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label" for="form3Example3">Correo Electronico</label>
                                            <input type="email" id="form3Example3" class="form-control"
                                                name="email" />
                                        </div>
                                        <!-- username-->
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label" for="form3Example3">Username</label>
                                            <input type="text" id="form3Example3" class="form-control"
                                                name="username" />
                                        </div>
                                    </div>

                                    <!-- Nombre y apellido input-->
                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="form3Example3">Nombre y apellido</label>
                                        <input type="text" id="form3Example3" class="form-control" name="nombre" />
                                    </div>

                                    <!-- cedula-->
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1">Cedula</label>
                                                <input type="text" id="form3Example1" class="form-control"
                                                    name="cedula" />
                                            </div>
                                        </div>
                                        <!-- telefono-->
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example2">telefono</label>
                                                <input type="text" id="form3Example2" class="form-control"
                                                    name="celular" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Password input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example4">Contraseña</label>
                                        <input type="password" id="form3Example4" class="form-control"
                                            name="password" />
                                    </div>

                                    <!--Confirmed Password-->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example4">Confirmar Contraseña</label>
                                        <input type="password" id="form3Example4" class="form-control"
                                            name="password_confirmation" />
                                    </div>

                                    <div class="form-outline mb-4" style="width: 50%;">
                                        <label class="form-label" for="form3Example4">Genero</label>
                                        <select class="form-select" required aria-label="Default select example"
                                            name="genero">
                                            <option selected disabled>Genero</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                        </select>
                                    </div>

                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-primary btn-block mb-4" value="Registrarse">
                                        Registrarse
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
