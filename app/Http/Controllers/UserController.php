<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Listar usuarios (solo admin)
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 5); // Valor por defecto: 5 registros por página

        $usuarios = DB::table('users')
            ->where('rol', 'Admin')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            })
            ->paginate($perPage);

        $titulo = "Gestión de Usuarios";
        return view('modules.users.index', compact('usuarios', 'titulo', 'perPage'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        $titulo = "Crear Usuario";
        return view('modules.users.create', compact('titulo'));
    }

    // Guardar un nuevo usuario
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'rol' => 'required|in:admin,user', // Asegura que el rol sea "admin" o "user"
            'activo' => 'required|boolean', // Asegura que el estado sea un booleano (1 o 0)
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico no es válido.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
            'rol.required' => 'El rol es obligatorio.',
            'rol.in' => 'El rol seleccionado no es válido.',
            'activo.required' => 'El estado es obligatorio.',
            'activo.boolean' => 'El estado debe ser activo o inactivo.',
        ]);

        // Crear el usuario con Query Builder
        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
            'activo' => $request->activo,
            'created_by' => Auth::id(), // Registrar quién creó al usuario
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $usuario = DB::table('users')->where('id', $id)->first();
        $titulo = "Editar Usuario";
        return view('modules.users.edit', compact('usuario', 'titulo'));
    }

    // Actualizar un usuario
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'rol' => 'required|in:admin,user', // Asegura que el rol sea "admin" o "user"
            'activo' => 'required|boolean', // Asegura que el estado sea un booleano (1 o 0)
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico no es válido.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
            'rol.required' => 'El rol es obligatorio.',
            'rol.in' => 'El rol seleccionado no es válido.',
            'activo.required' => 'El estado es obligatorio.',
            'activo.boolean' => 'El estado debe ser activo o inactivo.',
        ]);

        // Preparar los datos para actualizar
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'rol' => $request->rol,
            'activo' => $request->activo,
            'updated_at' => now(),
        ];

        // Si se proporciona una nueva contraseña, actualizarla
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        // Actualizar el usuario con Query Builder
        DB::table('users')->where('id', $id)->update($data);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }
}