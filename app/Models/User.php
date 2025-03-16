<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Los atributos que son asignables en masa.
     * Estos campos pueden ser llenados directamente al crear o actualizar un usuario.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',       // Nombre del usuario
        'email',      // Correo electrónico del usuario
        'password',   // Contraseña del usuario (se almacena encriptada)
        'activo',     // Estado del usuario (activo/inactivo)
        'rol',        // Rol del usuario (admin/user)
    ];

    /**
     * Los atributos que deben estar ocultos para la serialización.
     * Estos campos no se incluirán en las respuestas JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',         // Contraseña (no se debe exponer)
        'remember_token',   // Token para "recordar" la sesión del usuario
    ];

    /**
     * Obtener los atributos que deben ser convertidos a tipos nativos.
     * Esto permite que Laravel maneje automáticamente la conversión de tipos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Convertir 'email_verified_at' a tipo datetime
            'activo' => 'boolean',             // Convertir 'activo' a tipo booleano
        ];
    }

    /**
     * Encriptar automáticamente la contraseña antes de guardarla en la base de datos.
     * Este método se llama automáticamente cuando se asigna un valor al campo 'password'.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value); // Encriptar la contraseña usando bcrypt
    }

    /**
     * Formatear el valor del campo 'rol' a mayúscula inicial.
     * Este método se llama automáticamente cuando se accede al campo 'rol'.
     *
     * @param  string  $value
     * @return string
     */
    public function getRolAttribute($value)
    {
        return ucfirst($value); // Convertir el valor a mayúscula inicial
    }
}