<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // Importar DB para usar Query Builder

class AuthController extends Controller
{
    public function index()
    {
        $titulo = "Iniciar Sesión";
        return view("modules.auth.login", compact("titulo"));
    }

    public function login(Request $request)
    {
        // Validar datos de credenciales
        $credenciales = $request->validate([
            "email" => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico no es válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        // Buscar el usuario usando Query Builder
        $user = DB::table('users')->where('email', $request->email)->first();

        // Validar user y password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Credenciales incorrectas.'])->withInput();
        }

        // Validar que el usuario esté activo
        if (!$user->activo) {
            return back()->withErrors(['email' => 'La cuenta está inactiva.']);
        }

        // Crear la sesión del usuario manualmente
        Auth::loginUsingId($user->id);

        // Regenerar la sesión
        $request->session()->regenerate();
        return to_route('home');
    }

    public function crearAdmin()
    {
        // Crear un usuario administrador usando Query Builder
        DB::table('users')->insert([
            'name' => 'Danielvis',
            'email' => 'danielvisramos31@gmail.com',
            'password' => Hash::make('admin'),
            'activo' => true,
            'rol' => "admin",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return "¡Administrador creado con éxito!";
    }

    public function logout(Request $request)
    {
        // Cerrar sesión
        Auth::logout();
        return to_route("login");
    }

    // Método para mostrar el formulario de cambio de contraseña
    public function showChangePasswordForm()
    {
        $titulo = "Cambiar Contraseña";
        return view("modules.auth.change-password", compact("titulo"));
    }

    // Método para procesar el cambio de contraseña
    public function changePassword(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'La contraseña actual es obligatoria.',
            'new_password.required' => 'La nueva contraseña es obligatoria.',
            'new_password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'new_password.confirmed' => 'La confirmación de la nueva contraseña no coincide.',
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar que la contraseña actual sea correcta
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.']);
        }

        // Actualizar la contraseña usando Query Builder
        DB::table('users')
            ->where('id', $user->id)
            ->update(['password' => Hash::make($request->new_password)]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('home')->with('success', 'Contraseña cambiada exitosamente.');
    }
}