<header class="header border-bottom mb-0" style="border-bottom: 2px solid red;">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div style="width: 100%">
            <div class="container-fluid px-0">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="/home">
                                <img src="{{ asset('assets/img/aea.png') }}" alt="" width="200px"
                                    class="d-inline-block align-text-top">
                            </a>
                        </div>
                    </ul>
                    @auth
                        <div class="navbar-nav me-auto mb-2 mb-lg-0 container-fluid d-flex justify-content-md-center"
                            style="width: 100%;">
                            <li class="nav-item me-5 mb-2 mb-lg-0" style="width:  auto;">
                                <a class="nav-link" href="/service">
                                    <h5>Servicios</h5>
                                </a>
                            </li>

                            <li class="nav-item me-5 mb-2 mb-lg-0" style="width:  auto;">
                                <a class="nav-link" href="#">
                                    <h5>Sobre Nosotros</h5>
                                </a>
                            </li>

                            <li class="nav-item me-5 mb-2 mb-lg-0" style="width:  auto;">
                                <a class="nav-link" href="/pqr">
                                    <h5>Ayuda/PQR</h5>
                                </a>
                            </li>
                        </div>

                        <form class="d-flex">
                            <ul class="navbar-nav me-5 mb-2 mb-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ asset('/storage/assets/img/perfilImagenes/' . auth()->user()->id . '.jpg') }}"
                                            alt="" width="32" height="32" class="rounded-circle me-2">
                                        {{ auth()->user()->username }}
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="/gestionJobs">Gestionar Trabajos</a></li>
                                        <li><a class="dropdown-item" href="/perfil">Perfil</a></li>
                                        @if(auth()->user()->tipo === 'Administrador')
                                            <li><a class="dropdown-item" href="/administrador">Panel Administrador</a></li>
                                        @endif
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="/logout">Cerrar Sesion</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </form>
                    @endauth
                </div>
                <hr class="p-0 m-0">
            </div>
            <div style="height: 30px;">
                <div class="navbar-nav me-auto mb-2 mb-lg-0 container-fluid d-flex justify-content-md-center"
                    style="width: 100%;">
                    <li class="nav-item me-5 mb-2 mb-lg-0" style="width:  auto;">
                        <a class="nav-link" href="/gestionJobs">
                            <h5>Gestionar trabajos</h5>
                        </a>
                    </li>

                    <li class="nav-item me-5 mb-2 mb-lg-0" style="width:  auto;">
                        <a class="nav-link" href="/gestionJobs/solicitudes">
                            <h5>Solicitudes</h5>
                        </a>
                    </li>
                    @if(auth()->user()->tipo === 'Trabajador')
                        <li class="nav-item me-5 mb-2 mb-lg-0" style="width:  auto;">
                            <a class="nav-link" href="/gestionJobs/pendientes">
                                <h5>Pendientes</h5>
                            </a>
                        </li>
                    @endif
                </div>
            </div>
        </div>
    </nav>

</header>