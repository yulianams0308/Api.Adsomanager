<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apprentice;

class ApprenticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $apprentices=Apprentice::all();
        $apprentices=Apprentice::included()->filter()->sort()->get();
        return $apprentices;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'estado' => 'required|max:255',
            'etapa' => 'required|max:255',
            'slug' => 'required|max:255|unique:apprentices',
        ]);

        $apprentice=Apprentice::create($request->all());
        return $apprentice;
    }

    /**
     * Display the specified resource.
     */
    public function show(Apprentice $apprentice)
    {
        // $apprentices = Apprentice::with(['datasheet'])->findOrFail($apprentice->id);
        $apprentices  = Apprentice::included()->FindOrFail($apprentice->id);
        return $apprentices;
    }

    /**
     * Update the specified resource in storage.
    */

    public function update(Request $request, Apprentice $apprentice)
    {

        $request->validate([
            'estado' => 'required|max:255',
            'etapa' => 'required|max:255|in:Lectiva,Productiva',
            'slug' => 'required|max:255|unique:apprentices',
        ]);

        $apprentice->update($request->all());
    
    }

    /*
     * Remove the specified resource from storage.
     */

    public function destroy(Apprentice $apprentice)
    {

        $apprentice->delete();
        return $apprentice;

    }
}
