<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
//crear usuario admin
Route::get('/crear-admin', [AuthController::class,'crearAdmin'])->name('crearAdmin');
//ruta del indice
Route::middleware("auth")->group(function () {
    //ruta del dashboard
    Route::get('/home', [Dashboard::class, 'index'])->name('home');
    //logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
//login
Route::get('/', [AuthController::class, 'index'])->name('login');
//logear
Route::post('/logear', [AuthController::class, 'login'])->name('logear');


//ruta de cambiar contraseña
Route::prefix('contraseña')->middleware("auth")->group(function () {
    // Cambiar contraseña (formulario)
    Route::get('/cambiar-contraseña', [AuthController::class, 'showChangePasswordForm'])->name('contraseña-cambiar');

    // Cambiar contraseña (procesar formulario)
    Route::post('/cambiar-contraseña', [AuthController::class, 'changePassword'])->name('contraseña-cambiar.post');
});

//ruta de perfil
Route::prefix('perfil')->middleware('auth')->group(function () {
    // Mostrar el formulario de mi perfil
    Route::get('/', [AuthController::class, 'showProfile'])->name('perfil');
});

//ruta de usuarios
Route::prefix('usuarios')->middleware('auth')->group(function () {
    // Listar usuarios
    Route::get('/', [UserController::class, 'index'])->name('usuarios.index');

    // Mostrar formulario de creación
    Route::get('/crear', [UserController::class, 'create'])->name('usuarios.create');

    // Guardar un nuevo usuario
    Route::post('/', [UserController::class, 'store'])->name('usuarios.store');

    // Mostrar formulario de edición
    Route::get('/{id}/editar', [UserController::class, 'edit'])->name('usuarios.edit');

    // Actualizar un usuario
    Route::put('/{id}', [UserController::class, 'update'])->name('usuarios.update');

    // Eliminar un usuario
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('usuarios.destroy');
});
