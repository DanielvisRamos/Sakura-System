<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecutar las migraciones.
     */
    public function up(): void
    {
        // Crear la tabla 'users' para almacenar información de los usuarios
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // ID único del usuario (clave primaria)
            $table->string('name'); // Nombre del usuario
            $table->string('email')->unique(); // Correo electrónico único del usuario
            $table->timestamp('email_verified_at')->nullable(); // Fecha de verificación del correo electrónico (puede ser nulo)
            $table->string('password'); // Contraseña del usuario (se almacena encriptada)
            $table->boolean('activo')->default(true); // Estado del usuario (activo/inactivo, por defecto activo)
            $table->enum('rol', ['admin', 'user'])->default('user'); // Rol del usuario (admin/user, por defecto user)
            $table->rememberToken(); // Token para "recordar" la sesión del usuario
            $table->timestamps(); // Fechas de creación y actualización automáticas
        });

        // Crear la tabla 'password_reset_tokens' para almacenar tokens de restablecimiento de contraseña
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Correo electrónico del usuario (clave primaria)
            $table->string('token'); // Token para restablecer la contraseña
            $table->timestamp('created_at')->nullable(); // Fecha de creación del token (puede ser nulo)
        });

        // Crear la tabla 'sessions' para almacenar información de las sesiones de los usuarios
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // ID único de la sesión (clave primaria)
            $table->foreignId('user_id')->nullable()->index(); // ID del usuario (clave foránea, puede ser nulo)
            $table->string('ip_address', 45)->nullable(); // Dirección IP del usuario (puede ser nulo)
            $table->text('user_agent')->nullable(); // Información del navegador o dispositivo del usuario (puede ser nulo)
            $table->longText('payload'); // Datos de la sesión (almacenados como texto largo)
            $table->integer('last_activity')->index(); // Fecha de la última actividad en la sesión (índice)
        });
    }

    /**
     * Revertir las migraciones.
     */
    public function down(): void
    {
        // Eliminar la tabla 'sessions' si existe
        Schema::dropIfExists('sessions');

        // Eliminar la tabla 'password_reset_tokens' si existe
        Schema::dropIfExists('password_reset_tokens');

        // Eliminar la tabla 'users' si existe
        Schema::dropIfExists('users');
    }
};