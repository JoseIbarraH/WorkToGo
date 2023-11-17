@extends('layouts\app-master-3')

@section('content')
    @php
        use App\Models\User;
    @endphp
    <br><br>
    <h1>Servicios Pendientes</h1>
    @foreach ($services as $servicio)
        @if ($servicio->estado === 'Activo' || $servicio->estado === 'Pendiente')
            @foreach ($result as $results)
                @php
                    $user = User::find($results->service_user_id);
                @endphp
                @if (
                    $servicio->id === $results->id_servicio &&
                        $results->estado === 'Pendiente' &&
                        $servicio->estado === 'Pendiente' &&
                        $results->id_usuario === auth()->user()->id)
                    <div class="mt-3 card p-3" style="width: 100%; height: auto;">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>{{ $results->titulo }}</h3>
                                <div style="display: flex">
                                    <img src="{{ asset('/storage/assets/img/perfilImagenes/' . $user->id . '.jpg') }}" alt="" width="32" height="32" class="rounded-circle me-2">
                                    <h3 class="m-0">{{ $user->nombre }}</h3>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Estado: </h3>
                                        <h4 style="color: orangered">{{ $results->estado }}</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h3>Telefono: </h3>
                                        <h4>{{ $user->celular }}</h4>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="mt-3">
                                <h4>Descripcion: </h4>
                                <h5>{{ $servicio->direccion}}</h5>
                            </div>
                            <div class="mt-3">
                                <h4>Descripcion: </h4>
                                <h5>{{ $results->descripcion }}</h5>
                            </div>
                            
                        </div>
                        
                        
                        
                    </div>
                @endif
            @endforeach
        @endif
    @endforeach
@endsection
