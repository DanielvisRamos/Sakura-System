@extends('layouts.main')
@section('titulo', $titulo)
@section('contenido')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Crear Usuario</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
                    <li class="breadcrumb-item active">Crear</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Formulario de Creación</h5>

                            <!-- Formulario de creación -->
                            <form action="{{ route('usuarios.store') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="password" class="col-sm-2 col-form-label">Contraseña</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" name="password" required>
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="password_confirmation" class="col-sm-2 col-form-label">Confirmar Contraseña</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="rol" class="col-sm-2 col-form-label">Rol</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="rol" name="rol" required>
                                            <option value="admin" {{ old('rol') == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="user" {{ old('rol') == 'user' ? 'selected' : '' }}>User</option>
                                        </select>
                                        @error('rol')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="activo" class="col-sm-2 col-form-label">Estado</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="activo" name="activo" required>
                                            <option value="1" {{ old('activo') == 1 ? 'selected' : '' }}>Activo</option>
                                            <option value="0" {{ old('activo') == 0 ? 'selected' : '' }}>Inactivo</option>
                                        </select>
                                        @error('activo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection