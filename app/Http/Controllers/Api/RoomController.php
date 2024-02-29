<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $rooms = Room::all();
        $rooms = Room::included()->filter()->sort()->get();
        return response()->json($rooms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'num_salon'=> 'required|max:255',
            'sede'=> 'required|max:255',
            'capacidad'=> 'required|max:255',
            'observacion'=> 'required|max:255',
            'slug'=> 'required|unique:rooms|max:255',
        ]);

        $room = Room::create($request->all());
        return response()->json($room, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        $rooms  = Room::included()->FindOrFail($room->id);
        return response()->json($rooms, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {

        $request->validate([
            'num_salon'=> 'required|max:255',
            'sede'=> 'required|max:255',
            'capacidad'=> 'required|max:255',
            'observacion'=> 'required|max:255',
            'slug'=> 'required|unique:rooms|max:255',
        ]);


        $room->update($request->all());
        return response()->json($room, 203);    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json([], 204);
    }
}
