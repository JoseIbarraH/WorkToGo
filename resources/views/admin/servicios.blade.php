@extends('layouts\app-master-4')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    @auth
        <br><br>
        <div>
            <h1>Lista De Servicios</h1>

            <table id="example" class="table table-striped nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Titulo</th>
                        <th>Direccion</th>
                        <th>Descripcion</th>
                        <th>tipoServicio</th>
                        <th>Costo</th>
                        <th>Estado</th>
                        <th>Creacion</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <div hidden>{{ $na = 0 }}</div>
                    @foreach ($servicios as $servicio)
                        <tr>
                            <td>{{ $servicio->id }}</td>
                            <td>{{ $servicio->titulo }}</td>
                            <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100px;">
                                {{ $servicio->direccion }}</td>
                            <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100px;">
                                {{ $servicio->descripcion }}</td>
                            <td>{{ $servicio->tipoServicio }}</td>
                            <td>{{ $servicio->costo }}</td>
                            <td>{{ $servicio->estado }}</td>
                            <td>{{ $servicio->created_at }}</td>
                            <td>
                                <button class="btn btn-danger bi bi-trash mx-1" data-bs-toggle="modal"
                                    data-bs-target="#editarmodal{{ $servicio->id }}"></button>
                            </td>

                            <div class="modal fade" id="editarmodal{{ $servicio->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">ELiminar</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div style="width: 100%; text-align: center">
                                                <a class="bi bi-exclamation-circle"
                                                    style="width: 100%; font-size: 100px; color: red"></a>
                                            </div>
                                            <div style="width: 100%">
                                                <h2 style="width: 100%; text-align: center">¿Seguro
                                                    que desea eliminar este servicio?</h2>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <form action="{{ route('admin.serviceDelete') }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <input type="text" id="servicio" name="servicio" hidden
                                                    value="{{ $servicio->id }}">
                                                <button class="btn btn-danger" type="submit">Eliminar</button>
                                            </form>
                                        </div>
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
                        "sSearch": "Buscar servicio:",
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
