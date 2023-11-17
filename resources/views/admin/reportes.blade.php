@extends('layouts\app-master-4')
@php
    use App\Models\User;
    use App\Models\Servicio;
@endphp
@section('content')
    @auth
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <br><br>
        <div>
            <h1>Lista De Reportes</h1>

            <table id="example" class="table table-striped nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Fecha Creacion</th>
                        <th>Estado</th>
                        <th>Usuario cc</th>
                        <th>Autor cc</th>
                        <td>Servicio</td>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <div hidden>{{ $na = 0 }}</div>
                    @foreach ($reportes as $reporte)
                        <tr>
                            <td>{{ $reporte->id }}</td>
                            <td>{{ $reporte->titulo }}</td>
                            <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100px;">
                                {{ $reporte->descripcion }}</td>
                            <td>{{ $reporte->fechaCreacion }}</td>
                            <td>{{ $reporte->estado }}</td>
                            @php
                                $usuario = User::find($reporte->id_usuario);

                                $servicio = Servicio::find($reporte->id_servicio);
                                $user = User::find($servicio->id_usuario);
                            @endphp
                            <td>{{ $usuario->cedula }}</td>
                            <td>{{ $user->cedula }}</td>
                            <td>{{ $reporte->id_servicio }}</td>
                            <td>
                                <button class="btn btn-danger bi bi-trash mx-1" data-bs-toggle="modal"
                                    data-bs-target="#editarmodal{{ $reporte->id }}"></button>
                            </td>

                            <div class="modal fade" id="editarmodal{{ $reporte->id }}" tabindex="-1"
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
                                                <h2 style="width: 100%; text-align: center">¿Seguro que desea eliminar este
                                                    reporte?</h2>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <form action="{{ route('admin.delete.reportes', $reporte) }}" method="POST">
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
