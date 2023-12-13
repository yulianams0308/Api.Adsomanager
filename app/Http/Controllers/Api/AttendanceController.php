<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Models\Session;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $attendances = Attendance::all();
        $attendances=Attendance::included()->filter()->sort()->get();
        return $attendances;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'asistio'=> 'required|in:0,1|max:255',
            'slug'=> 'required|unique:attendances|max:255',
            'sesion_id'=> 'required|max:255',
            'aprendiz_id'=> 'required|max:255',

        ]);

        $attendances = Attendance::create($request->all());

        return $attendances;
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        $attendance  = Attendance::included()->FindOrFail($attendance->id);
        return $attendance;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance  $attendance)
    {
        $request->validate([
            'asistio'=> 'required|in:0,1|max:255',
            'slug'=> 'required|max:255',
            'sesion_id'=> 'required',
            'aprendiz_id'=> 'required',
        ]);

        $attendance->update($request->all());
        return $attendance;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return $attendance;
    }
}
