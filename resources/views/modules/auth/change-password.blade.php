@extends('layouts.main')
@section('titulo', $titulo)
@section('contenido')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Cambiar Contraseña</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Cambio de Contraseña</li>
                </ol>
            </nav>
        </div>

        <div class="row justify-content-sm-start">
            <div class="col-md-8">
                <div class="card mt-3">
                    <div class="card-header">{{ __('Cambiar Contraseña') }}</div>

                    <div class="card-body">
                        <!-- Formulario de cambio de contraseña -->
                        <form id="change-password-form" action="{{ route('contraseña-cambiar.post') }}" method="POST">
                            @csrf

                            <!-- Contraseña Actual -->
                            <div class="mb-3 mt-2">
                                <label for="current_password" class="form-label">{{ __('Contraseña Actual') }}</label>
                                <input type="password" name="current_password" class="form-control" required>
                                @error('current_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nueva Contraseña -->
                            <div class="mb-3">
                                <label for="new_password" class="form-label">{{ __('Nueva Contraseña') }}</label>
                                <input type="password" name="new_password" class="form-control" required>
                                @error('new_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirmar Nueva Contraseña -->
                            <div class="mb-3">
                                <label for="new_password_confirmation"
                                    class="form-label">{{ __('Confirmar Nueva Contraseña') }}</label>
                                <input type="password" name="new_password_confirmation" class="form-control" required>
                            </div>

                            <!-- Botón de envío -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">{{ __('Cambiar Contraseña') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
