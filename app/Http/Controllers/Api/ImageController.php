<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Competence;
class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $images = Image::all();
        $images=Image::included()->filter()->sort()->get();
        return $images;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "url"=> "unique:images",
            "imageable_type"=> "required",
            "slug"=> "required|unique:images|max:500",
            "imageable_id"=> "required",
            "user_id"=> "required",
        ]);

        $image = Image::create($request->all());
        return $image;
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        $images  = Competence::included()->FindOrFail($image->id);
        return $images;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        $request->validate([
            "url"=> "unique:images",
            "imageable_type"=> "required",
            "imageable_id"=> "required",
            "user_id"=> "required",
        ]);

        $image->update($request->all());
        return $image;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        $image->delete();
        return $image;
    }
}
