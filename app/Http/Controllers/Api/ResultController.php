<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\Instructor;
class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$results = Result::all();
        $results = Result::included()->filter()->sort()->get();
        return $results;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_resultado'=> 'required|max:255',
            'descripcion'=> 'required|max:255',
            'horas'=> 'required|max:24',
            'fecha_inicio'=> 'required|max:200',
            'fecha_fin'=> 'required|max:200',
            'url_formato'=> 'required|max:255',
            'slug'=> 'required|unique:instructors|max:255',
            'instructor_id'=> 'required|max:255',
            'competence_id'=> 'required|max:255',
        ]);

        $instructor = Instructor::create($request->all());
        return $instructor;

    }

    /**
     * Display the specified resource.
     */
    public function show(string $result)
    {
        $result  = Result::included()->FindOrFail($result);
        return $result;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Result $result)
    {
        $request->validate([
            'nombre_resultado'=> 'required|max:255',
            'descripcion'=> 'required|max:255',
            'horas'=> 'required|max:24',
            'fecha_inicio'=> 'required|max:200',
            'fecha_fin'=> 'required|max:200',
            'url_formato'=> 'required|max:255',
            'slug'=> 'required|unique:instructors|max:255',
            'instructor_id'=> 'required|max:255',
            'competence_id'=> 'required|max:255',
        ]);

        $result->update($request->all());
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $result)
    {
        $result->delete();

        return $result;
    }
}
