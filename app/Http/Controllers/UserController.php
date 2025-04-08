<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log; // ← Añade esta línea

class UserController extends Controller
{
    // Listar usuarios
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('users.create');
    }

    // Guardar nuevo usuario
    public function store(Request $request)
    {
        DB::beginTransaction();
        
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            
            DB::commit();
            
            return redirect()->route('users.index')
                   ->with('success', 'Usuario creado correctamente');
                   
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                   ->with('error', 'Error: '.$e->getMessage());
        }
    }

    // Mostrar formulario de edición
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Actualizar usuario
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // Eliminar usuario
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
