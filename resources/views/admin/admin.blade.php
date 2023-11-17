@extends('layouts\app-master-4')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    @auth
        <br><br>
        <div>
            <h1>Lista De Usuarios</h1>

            <table id="example" class="table table-striped nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Celular</th>
                        <th>Genero</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Service</th>
                        <th>Fecha Ingreso</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <div hidden>{{ $na = 0 }}</div>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->cedula }}</td>
                            <td>{{ $usuario->nombre }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->username }}</td>
                            <td>{{ $usuario->celular }}</td>
                            <td>{{ $usuario->genero }}</td>
                            <td>{{ $usuario->tipo }}</td>
                            <td>{{ $usuario->estado }}</td>
                            <td>{{ $usuario->service }}</td>
                            <td>{{ $usuario->created_at }}</td>
                            <td style="display: flex;">
                                <button class="btn btn-primary bi bi-pencil-square mx-1" data-bs-toggle="modal"
                                    data-bs-target="#editarmodal{{ $usuario->id }}"></button>

                                @if ($usuario->estado === 'Activo')
                                    <form action="{{ route('admin.suspender') }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <input type="text" id="inputid" name="inputid" value="{{ $usuario->id }}" hidden>
                                        <button class="btn btn-success bi bi-check-circle" type="submit"></button>
                                    </form>
                                @elseif($usuario->estado === 'Inactivo')
                                    <form action="{{ route('admin.suspender') }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <input type="text" id="inputid" name="inputid" value="{{ $usuario->id }}" hidden>
                                        <button class="btn btn-danger bi bi-ban" type="submit"></button>
                                    </form>
                                @endif

                            </td>

                            <div class="modal fade" id="editarmodal{{ $usuario->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.update') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="mt-2" for="inputname">Nombre: </label>
                                                        <input type="text" class="form-control" name="inputname"
                                                            id="inputname" value="{{ $usuario->nombre }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="mt-2" for="inputusername">Username: </label>
                                                        <input type="text" class="form-control" name="inputusername"
                                                            id="inputusername" value="{{ $usuario->username }}">
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="mt-2" for="inputemail">Email: </label>
                                                    <input type="text" class="form-control" name="inputemail" id="inputemail"
                                                        value="{{ $usuario->email }}">
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="mt-2" for="inputcelular">Celular: </label>
                                                        <input type="text" class="form-control" name="inputcelular"
                                                            id="inputcelular" value="{{ $usuario->celular }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="mt-2" for="inputgenero">Genero: </label>
                                                        <select class="form-select" required aria-label="Default select example"
                                                            name="inputgenero" id="inputgenero">
                                                            <option selected disabled>Genero</option>
                                                            <option value="Masculino"
                                                                {{ $usuario->genero == 'Masculino' ? 'selected' : '' }}>
                                                                Masculino
                                                            </option>
                                                            <option value="Femenino"
                                                                {{ $usuario->genero == 'Femenino' ? 'selected' : '' }}>Femenino
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="mt-2" for="inputtipo">Tipo de usuario: </label>
                                                        <select class="form-select" required aria-label="Default select example"
                                                            name="inputtipo" id="inputtipo">
                                                            <option selected disabled>Tipo</option>
                                                            <option value="Administrador"
                                                                {{ $usuario->tipo == 'Administrador' ? 'selected' : '' }}>
                                                                Administrador
                                                            </option>
                                                            <option value="Cliente"
                                                                {{ $usuario->tipo == 'Cliente' ? 'selected' : '' }}>Cliente
                                                            </option>
                                                            <option value="Trabajador"
                                                                {{ $usuario->tipo == 'Trabajador' ? 'selected' : '' }}>
                                                                Trabajador
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="mt-2" for="inputcedula">Cedula: </label>
                                                        <input type="text" id="inputcedula" name="inputcedula"
                                                            value="{{ $usuario->cedula }}" class="form-control">
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="mt-2" for="inputpassword">Cambiar contraseña: </label>
                                                    <input type="password" id="inputpassword" name="inputpassword"
                                                        value="" class="form-control">
                                                </div>
                                                <input type="text" id="inputid" name="inputid"
                                                    value="{{ $usuario->id }}" hidden>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Editar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </tr>
                        <div hidden>{{ $na = $na + 1 }}</div>
                    @endforeach
                </tbody>
            </table>

            <script>
                new DataTable('#example', {
                    responsive: true
                });
            </script>

        </div>

        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#example').DataTable({
                    "language": {
                        "lengthMenu": "Mostrar MENU registros",
                        "zeroRecords": "No se encontraron resultados",
                        "lengthMenu": "Registro de usuarios",
                        "zeroRecords": "No se encontraron resultados",
                        "info": "Registros Totales: {{ $na }}",
                        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "infoFiltered": "(filtrado de un total de MAX registros)",
                        "sSearch": "Buscar usuario:",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Ultimo",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },

                        "sProcessing": "Procesando...",
                    }
                });
            });
        </script>
    @endauth
@endsection
