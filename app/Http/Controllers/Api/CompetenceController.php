<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Competence;

class CompetenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $competence = Competence::all();
        $competences=Competence::included()->filter()->sort()->get();
        return response()->json($competences);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_competencia'=> 'required|max:400',
            'descripcion'=> 'required|max:350',
            'anexo'=> 'required',
            'slug'=> 'required|unique:competences|max:255',
        ]);

        $competence = Competence::create($request->all());
        return response()->json($competence, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Competence $competence)
    {
        $competences  = Competence::included()->FindOrFail($competence->id);
        return response()->json($competences, 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Competence $competence)
    {

        $request->validate([
            'nombre_competencia'=> 'required|max:400',
            'descripcion'=> 'required|max:350',
            'anexo'=> 'required',
            'slug'=> 'required|unique:competences|max:255',
        ]);

        $competence->update($request->all());

        return response()->json($competence, 203);   

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Competence $competence)
    {
        $competence->delete();
        return response()->json([], 204);
    }
}
