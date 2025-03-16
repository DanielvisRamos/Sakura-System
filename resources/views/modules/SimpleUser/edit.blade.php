@extends('layouts.main')
@section('titulo', $titulo)
@section('contenido')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Editar Usuario</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('usuarios_simple.index') }}">Usuarios Simple</a></li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Formulario de Edición</h5>

                            <!-- Formulario de edición -->
                            <form action="{{ route('usuarios_simple.update', $usuario->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $usuario->name }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $usuario->email }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="password" class="col-sm-2 col-form-label">Nueva Contraseña</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" name="password">
                                        <small class="text-muted">Dejar en blanco si no desea cambiar la contraseña.</small>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="password_confirmation" class="col-sm-2 col-form-label">Confirmar Contraseña</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="rol" class="col-sm-2 col-form-label">Rol</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="rol" name="rol" required>
                                            <option value="user" {{ $usuario->rol == 'user' ? 'selected' : '' }}>User</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="activo" class="col-sm-2 col-form-label">Estado</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="activo" name="activo" required>
                                            <option value="1" {{ $usuario->activo == 1 ? 'selected' : '' }}>Activo</option>
                                            <option value="0" {{ $usuario->activo == 0 ? 'selected' : '' }}>Inactivo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                    <a href="{{ route('usuarios_simple.index') }}" class="btn btn-secondary">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection