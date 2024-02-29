<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $instructors = Instructor::all();
        $instructors = Instructor::included()->filter()->sort()->get();
        return response()->json($instructors);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'profesion'=> 'required|max:255',
            'user_id'=> 'required|max:255',
            'slug'=> 'required|unique:instructors|max:255',
        ]);

        $instructor = Instructor::create($request->all());

        return response()->json($instructor, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Instructor $instructor)
    {
        $instructor  = Instructor::included()->FindOrFail($instructor->id);
        return response()->json($instructor, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Instructor $instructor)
    {

        $request->validate([
            'profesion'=> 'required|max:255',
            'user_id'=> 'required|max:255',
            'slug'=> 'required|unique:instructors|max:255',
        ]);

        $instructor->update($request->all());
        return response()->json($instructor, 203);   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instructor $instructor)
    {
        $instructor->delete();
        return response()->json([], 204);
    }
}
