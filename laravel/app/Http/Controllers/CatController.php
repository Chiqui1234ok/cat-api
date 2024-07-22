<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
// Model
use App\Models\Cat;


class CatController extends Controller
{
    public function store(Request $request)
    {
        $messages = array();
        $cat = null;

        Log::debug($request);
        Log::debug('auth id');
        Log::debug(Auth::id());

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'estimatedLife' => 'int',
            'origin' => 'required|string|max:255',
            'color_ids' => 'required|array',
            'color_ids.*' => 'exists:colors,id', // Color need to exist in pivot table
        ]);

        if ($validator->fails())
        {
            $messages = $validator->errors();
        } else
        {
            $validatedData = $validator->validated();
            // Create a new cat in DB
            $cat = Cat::create([
                'name' => $validatedData['name'],
                'breed' => $validatedData['breed'],
                'estimatedLife' => $validatedData['estimatedLife'],
                'origin' => $validatedData['origin'],
                'user_id' => Auth::id(),
            ]);
            $cat->colors()->sync($validatedData['color_ids']);
            
            if($cat && $cat->id) {
                $messages = array('You\'ve uploaded a new cat! It\'s so gorgeous!');
            }
        }

        return response()->json(
            [
                'messages' => $messages,
                'data' => $cat,
            ], 
            201
        );
    }
}
