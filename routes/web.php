<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard;
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
