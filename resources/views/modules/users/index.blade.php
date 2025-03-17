@extends('layouts.main')
@section('titulo', $titulo)
@section('contenido')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Gestión de Usuarios</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Usuarios</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Lista de Usuarios</h5>

                            <!-- Barra de búsqueda y botón de agregar nuevo -->
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <form action="{{ route('usuarios.index') }}" method="GET" class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Buscar..."
                                            value="{{ request('search') }}">
                                        <button type="submit" class="btn btn-primary">Buscar</button>
                                    </form>
                                </div>
                                <div class="col-md-4 text-end">
                                    <a href="{{ route('usuarios.create') }}" class="btn btn-success">
                                        <i class="bi bi-plus-circle"></i> Agregar Nuevo
                                    </a>
                                </div>
                            </div>

                            <!-- Selector de registros por página -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <form action="{{ route('usuarios.index') }}" method="GET" class="input-group">
                                        <select name="per_page" class="form-select" onchange="this.form.submit()">
                                            <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5 por página
                                            </option>
                                            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10 por página
                                            </option>
                                            <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20 por página
                                            </option>
                                            <option value="30" {{ $perPage == 30 ? 'selected' : '' }}>30 por página
                                            </option>
                                        </select>
                                    </form>
                                </div>
                            </div>

                            <!-- Tabla de usuarios -->
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Rol</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usuarios as $usuario)
                                        <tr>
                                            <td>{{ $usuario->name }}</td>
                                            <td>{{ $usuario->email }}</td>
                                            <td>{{ $usuario->rol }}</td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modaldetails{{ $usuario->id }}"><i
                                                        class="fa-solid fa-eye"></i></a>
                                                <a href="{{ route('usuarios.edit', $usuario->id) }}"
                                                    class="btn btn-sm btn-warning"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                            </td>
                                        </tr>
                                        <!-- Modal de details -->
                                        <div class="modal fade" id="modaldetails{{ $usuario->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detalles de
                                                            Usuario
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item"><b>Id:</b> {{ $usuario->id }}</li>
                                                            <li class="list-group-item"><b>Nombre:</b> {{ $usuario->name }}
                                                            </li>
                                                            <li class="list-group-item"><b>Correo:</b>
                                                                {{ $usuario->email }}</li>
                                                            <li class="list-group-item"><b>Estado:</b>
                                                                @if ($usuario->activo)
                                                                    <span>Activo</span>
                                                                @else
                                                                    <span>Inactivo</span>
                                                                @endif
                                                            </li>
                                                            <li class="list-group-item">
                                                                <b>Creado por:</b>
                                                                @php
                                                                    // Obtener el nombre del usuario que creó este registro
                                                                    $creator = DB::table('users')
                                                                        ->where('id', $usuario->created_by)
                                                                        ->first();
                                                                @endphp
                                                                @if ($creator)
                                                                    {{ $creator->name }} ({{ $creator->rol }})
                                                                @else
                                                                    <span>Desconocido</span>
                                                                @endif
                                                            </li>
                                                            <li class="list-group-item"><b>Rol: </b> {{ $usuario->rol }}
                                                            </li>
                                                            <li class="list-group-item"><b>Fecha de Creacion: </b>{{$usuario->created_at}}</li>
                                                            <li class="list-group-item"><b>Fecha de Edicion: </b>{{$usuario->updated_at}}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Paginación elegante -->
                            <div class="d-flex justify-content-end">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <!-- Botón "Anterior" -->
                                        @if ($usuarios->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link">&laquo;</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $usuarios->previousPageUrl() }}"
                                                    rel="prev">&laquo;</a>
                                            </li>
                                        @endif

                                        <!-- Números de página -->
                                        @foreach ($usuarios->getUrlRange(1, $usuarios->lastPage()) as $page => $url)
                                            <li class="page-item {{ $usuarios->currentPage() == $page ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endforeach

                                        <!-- Botón "Siguiente" -->
                                        @if ($usuarios->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $usuarios->nextPageUrl() }}"
                                                    rel="next">&raquo;</a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link">&raquo;</span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>

                            <!-- Información de paginación -->
                            <div class="d-flex justify-content-end mt-2">
                                <p class="text-muted">
                                    Mostrando {{ $usuarios->firstItem() }} a {{ $usuarios->lastItem() }} de
                                    {{ $usuarios->total() }} registros
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
