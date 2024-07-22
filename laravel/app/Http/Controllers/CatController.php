<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cat;

class CatController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'color_ids' => 'required|array',
            'color_ids.*' => 'exists:colors,id', // Color need to exist in pivot table
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'errors' => $validator->errors()
                ], 
                422
            );
        }

        // Create a new cat in DB
        $cat = new Cat();
        $cat->name = $request->input('name');
        $cat->color_ids = $request->input('color_ids'); // This field is json in my db
        $cat->save();

        return response()->json(
            [
                'message' => 'Cat created successfully',
                'cat' => $cat,
                'errors' => null
            ], 
            201
        );
    }
}
