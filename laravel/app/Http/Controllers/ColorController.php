<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
// Model
use App\Models\Color;


class ColorController extends Controller
{
    public function store(Request $request)
    {
        $messages = array();
        $color = null;

        Log::debug($request);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:colors',
            'hex' => 'required|string|max:6',
            'rgb' => 'required|string|max:11',
        ]);

        if ($validator->fails())
        {
            $messages = array_values($validator->errors()->toArray());
        } else
        {
            $validatedData = $validator->validated();
            // Create a new color in DB
            $color = Color::create([
                'name' => $validatedData['name'],
                'hex' => $validatedData['hex'],
                'rgb' => $validatedData['rgb'],
            ]);
            // $color->cats()->sync($validatedData['hex']);
            
            if($color && $color->id) {
                $messages = array('You\'ve uploaded a new color! Now let\'s link a color to a cat!');
            }
        }

        return response()->json(
            [
                'messages' => $messages,
                'data' => $color,
            ], 
            201
        );
    }
}
