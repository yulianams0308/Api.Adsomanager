<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $roles = Role::all();
        $roles = Role::included()->filter()->sort()->get();
        return $roles;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nombre_rol'=> 'required|in:Instructor,Aprendiz,Administrador|max:15',
        ]);

        $roles = Role::create($request->all());

        return $roles;

    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $roles  = Role::included()->FindOrFail($role->id);
        return $roles;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {

        $request->validate([
            'nombre_rol'=> 'required|in:Instructor,Aprendiz,Administrador|max:15',
        ]);

        $role->update($request->all());
        return $role;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return $role;
    }
}
