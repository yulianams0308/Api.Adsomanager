<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Datasheet;
class DatasheetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$datasheets = Datasheet::all();
        $datasheets=Datasheet::included()->filter()->sort()->get();
        return response()->json($datasheets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'numero_ficha'=> 'required|unique:datasheets|max:7|min:7',
                'programa'=> 'required|max:255',
                'slug'=> 'required|unique:datasheets|max:500',
            ]
        );
        $datasheet = Datasheet::create($request->all());
        return response()->json($datasheet, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Datasheet $datasheet)
    {
        $datasheets  = Datasheet::included()->FindOrFail($datasheet->id);
        return response()->json($datasheets, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Datasheet $datasheet)
    {
        $request->validate(
            [
                'numero_ficha'=> 'required|unique:datasheets|max:7|min:7',
                'programa'=> 'required|max:255',
                'slug'=> 'required|unique:datasheets|max:500',
            ]
        );

        $datasheet->update($request->all());
        return response()->json($datasheet, 203);    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Datasheet $datasheet)
    {
        $datasheet->delete();
        return response()->json([], 204);
    }
}
// 