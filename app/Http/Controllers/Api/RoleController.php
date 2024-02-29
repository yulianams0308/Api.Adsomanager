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
        return response()->json($roles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nombre_rol'=> 'required|in:Instructor,Aprendiz,Administrador|max:15',
        ]);

        $role = Role::create($request->all());
        return response()->json($role, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $roles  = Role::included()->FindOrFail($role->id);
        return response()->json($roles, 200);
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
        return response()->json($role, 203);   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json([], 204);
    }
}
