<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Session;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $sessions = Session::all();
        $sessions = Session::included()->filter()->sort()->get();
        return $sessions;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'observacion'=> 'required|max:255',
            'fecha_inicio'=> 'required|max:200',
            'fecha_fin'=> 'required|max:200',
            'ficha_id'=> 'required|max:255',
            'ambiente_id'=> 'required|max:255',
            'instructor_id'=> 'required|max:255',
            'slug'=>'required|unique:sessions|max:255',
        ]);

        $sessions = Session::create($request->all());
        return $sessions;
    }

    /**
     * Display the specified resource.
     */
    public function show(Session $session)
    {
        $sessions  = Session::included()->FindOrFail($session->id);
        return $sessions;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Session $session)
    {

        $request->validate([
            'observacion'=> 'required|max:255',
            'fecha_inicio'=> 'required|max:200',
            'fecha_fin'=> 'required|max:200',
            'ficha_id'=> 'required|max:255',
            'ambiente_id'=> 'required|max:255',
            'instructor_id'=> 'required|max:255',
            'slug'=>'required|unique:sessions|max:255',
        ]);

        $session->update($request->all());
        return $session;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session)
    {
        $session->delete();
        return $session;
    }
}
