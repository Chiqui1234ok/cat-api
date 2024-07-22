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

class AuthController extends Controller
{
    public function registerUser(Request $request)
    {
        try {
            // 1. Validate user's input
            $credentials = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $credentialsDb = null;

            // 2. Create user if validation pass
            if(!$credentials->fails())
            {
                $credentialsDb = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password,
                ]);
            }
            // 3. Return a response. Returns Token if the user was successfully registered
            return response()->json([
                'data' => [
                    'token' =>  !$credentials->fails() && $credentialsDb ?
                                $credentialsDb->createToken("API TOKEN")->plainTextToken : null
                ],
                'status' =>     !$credentials->fails() && $credentialsDb && $credentialsDb->id ?
                                true : false,
                'messages' =>   $credentials->fails() ?
                                $credentials->errors() :
                                array('user' => 'User registered successfully'),
            ], 200);
        } catch (\Exception $e)
        {
            Log::error('Server error: '.$e->getMessage());
    
            return response()->json([
                'success' => false,
                'messages' =>   array(
                                    'server' =>
                                    'Unknown error from the server. Please, try again in a few minutes.'
                                )
            ], 500);
        }
    }

    public function loginUser(Request $request)
    {
        try
        {
            Log::debug('request');
            Log::debug($request->all());
            // 1.Validate user's input
            $credentials = Validator::make($request->only('email', 'password'),
            [
                'email' => 'required|email',
                'password' => 'required|min:8',
            ]);

            // 2. Attempt login
            $auth = Auth::attempt($request->only('email', 'password'));
            Log::debug('auth');
            Log::debug($auth);
            if($credentials->fails() || !$auth)
            {
                // $request->session()->regenerate();
                return response()->json([
                    'success' => false,
                    // if array's empty, it's because validation doesn't fail, just the Auth attemp
                    'messages' =>   empty($credentials->errors()) ?
                                    array('user' => 'Incorrect email or password') :
                                    $credentials->errors()
                ], 401);
            }

            // $user = User::where($request->only('email', 'password'))->first();
            $user = Auth::user();
            $token = $user->createToken('API TOKEN')->plainTextToken;
            // 3. Return a nice response if the user loggued in correctly
            return response()->json([
                'success' => true,
                'data' => Auth::user(),
                'token' => $token,
                'messages' => array('user' => 'User logged-in successfully'),
            ]);
        } catch(\Exception $e)
        {
            Log::error('Server error: '.$e->getMessage());
    
            return response()->json([
                'success' => false,
                'messages' =>   array(
                                    'server' =>
                                    'Unknown error from the server. Please, try again in a few minutes.'
                                )
            ], 500);
        }
    }
}