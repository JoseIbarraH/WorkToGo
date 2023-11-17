@extends('layouts\app-master-4')
@php
    use App\Models\User;
@endphp
@section('content')
    @auth
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

        <br><br>
        <div>
            <h1>Lista De Usuarios</h1>

            <table id="example" class="table table-striped nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Tipo</th>
                        <th>Descripcion</th>
                        <th>FechaCreacion</th>
                        <th>Estado</th>
                        <th>Respuesta</th>
                        <th>FechaResolucion</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <div hidden>{{ $na = 0 }}</div>
                    @foreach ($pqrs as $pqr)
                        <tr>
                            <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100px;">
                                {{ $pqr->titulo }}</td>
                            <td>{{ $pqr->tipo }}</td>
                            <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100px;">
                                {{ $pqr->descripcion }}</td>
                            <td>{{ $pqr->fechaCreacion }}</td>
                            <td>{{ $pqr->estado }}</td>
                            <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100px;">
                                {{ $pqr->respuesta == null ? 'Sin Respuesta' : $pqr->respuesta }}</td>
                            <td>{{ $pqr->fechaResolucion == null ? 'Sin Respuesta' : $pqr->fechaResolucion }}</td>
                            @php
                                $usuarios = User::find($pqr->id_usuario);
                            @endphp
                            <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100px;">
                                {{ $usuarios->nombre }}</td>
                            <td>{{ $usuarios->email }}</td>
                            <td>
                                <button class="btn btn-primary mx-1" data-bs-toggle="modal"
                                    data-bs-target="#editarmodal{{ $pqr->id }}">Responder</button>
                                <button class="bi bi-trash btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $pqr->id }}"></button>
                            </td>

                            <div class="modal fade" id="exampleModal{{ $pqr->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Denegar
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div style="width: 100%; text-align: center">
                                                <a class="bi bi-exclamation-circle"
                                                    style="width: 100%; font-size: 100px; color: red"></a>
                                            </div>
                                            <div style="width: 100%">
                                                <h2 style="width: 100%; text-align: center">¿seguro
                                                    que desea eliminar?</h2>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <form action="{{ route('admin.pqrdelete') }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <input type="text" name="usuario" id="usuario" value="{{ $pqr->id }}"
                                                    hidden>
                                                <button class="btn btn-danger" type="submit">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="editarmodal{{ $pqr->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.respuesta') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Responder PQR</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div>
                                                    <input type="text" name="usuario" id="usuario"
                                                        value="{{ $pqr->id }}" hidden>
                                                    <label for="respuesta" class="mt-3">
                                                        <h3>Respuesta</h3>
                                                    </label>
                                                    <textarea class="form-control" name="respuesta" id="respuesta" style="width: 100%; height: 100px;"></textarea>
                                                    <label for="fechaResolucion" class="mt-3">
                                                        <h3>Fecha De Respuesta</h3>
                                                    </label>
                                                    <input type="date" class="form-control" name="fechaResolucion"
                                                        id="fechaResolucion">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Responder</button>
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
                        "lengthMenu": "Registro de pqrs",
                        "zeroRecords": "No se encontraron resultados",
                        "info": "Registros Totales: {{ $na }}",
                        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "infoFiltered": "(filtrado de un total de MAX registros)",
                        "sSearch": "Buscar pqr:",
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
