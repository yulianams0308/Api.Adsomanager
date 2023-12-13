<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = User::all();
        $users = User::included()->filter()->sort()->get();
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'user_id' => 'required|max:255',
            'slug' => 'required|unique:instructors|max:255',
            'password' => [
                'required',
                'string',
                'min:8',              // La contraseña debe tener al menos 8 caracteres.
                // 'confirmed',           // Debe haber un campo de confirmación de contraseña (por ejemplo, 'password_confirmation').
                // 'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]+$/',
            ],
            'imagen_perfil' => 'max:255',
            'role_id' => 'nullable',
        ]);

        $users = User::create($request->all());

        return $users;
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $users  = User::included()->FindOrFail($user->id);
        return $users;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'user_id' => 'required|max:255',
            'slug' => 'required|unique:instructors|max:255',
            'password' => [
                'required',
                'string',
                'min:8',              // La contraseña debe tener al menos 8 caracteres.
                // 'confirmed',           // Debe haber un campo de confirmación de contraseña (por ejemplo, 'password_confirmation').
                // 'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]+$/',
            ],
            'imagen_perfil' => 'max:255',
            'role_id' => 'nullable',
        ]);

        $user->update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $user;
    }
}
