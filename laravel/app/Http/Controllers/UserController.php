<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
// Model
use App\Models\User;

class UserController extends Controller
{
    public function profile()
    {
        try {
            $user = auth()->user();

            return response()->json([
                'status' => true,
                'messages' =>   $user && $user->id ? 
                                array('user' => 'User loaded successfully') :
                                array('user' => 'User can\'t be loaded, credentials are ok?'),
                'data' => $user,
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'messages' =>   array('Unknown error from the server. Please, try again in a few minutes.'),
                'data' => $user,
            ]);
        }
    }
}