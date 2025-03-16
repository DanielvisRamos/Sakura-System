@extends('layouts.main')
@section('titulo', $titulo)
@section('contenido')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Mi Perfil</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Mi Perfil</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <!-- Columna izquierda: Imagen y acciones -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body p-4 text-center">
                            <img src="{{ asset('NiceAdmin/assets/img/logo.png') }}" alt="Logo del sistema" class="img-fluid  mb-3 mt-3" style="width: 80px; height: 80px;">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <p class="card-text">{{ $user->email }}</p>

                            <!-- Botón para cambiar contraseña -->
                            <a href="{{ route('contraseña-cambiar') }}" class="btn btn-primary btn-sm ">
                                <i class="bi bi-key"></i> Cambiar Contraseña
                            </a>

                            <!-- Botón para cerrar sesión -->
                            <a href="#" class="btn btn-danger btn-sm" onclick="confirmLogout()">
                                <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Columna derecha: Información del usuario -->
                <div class="col-md-8">
                    <div class="card p-2">
                        <div class="card-body">
                            <h5 class="card-title">Información del Usuario</h5>

                            <div class="row m-0">
                                <div class="col-lg-3 col-md-4 label">Nombre:</div>
                                <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
                            </div>
                            <hr>
                            <div class="row m-0">
                                <div class="col-lg-3 col-md-4 label">Correo Electrónico:</div>
                                <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                            </div>
                            <hr>
                            <div class="row m-0">
                                <div class="col-lg-3 col-md-4 label">Rol</div>
                                <div class="col-lg-9 col-md-8">{{ $user->rol }}</div>
                            </div>
                            <hr>
                            <div class="row m-0">
                                <div class="col-lg-3 col-md-4 label">Estado</div>
                                <div class="col-lg-9 col-md-8">
                                    @if ($user->activo)
                                        <span class="badge bg-success">Activo</span>
                                    @else
                                        <span class="badge bg-danger">Inactivo</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Script para confirmar cierre de sesión -->
    <script>
        function confirmLogout() {
            Swal.fire({
                title: '¿Cerrar sesión?',
                text: '¿Estás seguro de que deseas cerrar sesión?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, cerrar sesión',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('logout') }}";
                }
            });
        }
    </script>
@endsection