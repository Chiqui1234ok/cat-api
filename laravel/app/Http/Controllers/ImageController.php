<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Store a newly created image in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cat_id' => 'required|exists:cats,id',
        ]);

        $file = $request->file('image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName, 'public');

        $image = Image::create([
            'file_name' => $fileName,
            'file_path' => Storage::url($filePath),
            'cat_id' => $request->cat_id,
        ]);

        return response()->json($image, 201);
    }

    /**
     * Display a listing of the images.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::with('cat')->get();

        return response()->json($images);
    }
}

