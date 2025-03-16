@extends('layouts.main')
@section("titulo", $titulo)
<!--Lo hice yo prf 👍 Danielvis Ramos-->
@section("contenido")
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>

        <section class="section contact">
            <!-- Contenido del dashboard -->
            
        </section>

    </main>
@endsection