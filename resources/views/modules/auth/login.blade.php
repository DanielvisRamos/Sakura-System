@extends('layouts.login')
@section('titulo', $titulo )

@section('contenido')
    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="#" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">Sakura System</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Iniciar Sesion</h5>
                                        <p class="text-center small">Ingresa tus datos para iniciar sesion</p>
                                    </div>

                                    <form class="row g-3 needs-validation" novalidate method="POST" action="{{route("logear")}}">
                                        @csrf
                                        <div class="col-12">
                                            <label for="email" class="form-label">Nombre de usuario</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="email" class="form-control" id="email"
                                                    required placeholder="usuario@gmail.com">
                                                <div class="invalid-feedback">Porfavor ingrese su nombre de usuario.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="password" class="form-label">Contraseña</label>
                                            <input type="password" name="password" class="form-control" id="password"
                                                required>
                                            <div class="invalid-feedback">Porfavor ingrese su contraseña</div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Iniciar sesion</button>
                                        </div>
                                    </form>
                                    <!--validacion de errores-->
                                    <div class="">
                                        @if ($errors->any())
                                            <p>
                                                <ul>
                                                    @foreach ($errors->all() as $error )
                                                        <li>{{$error}}</li>
                                                    @endforeach
                                                </ul>
                                            </p>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <div class="credits">
                                
                                Designed by <a target="_blank" href="#">Danielvis Ramos</a>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main>
@endsection
