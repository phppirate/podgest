<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(Request $request)
    {
        if(Auth::once($request->only('email', 'password'))){
            return response()->json([
                'api_token' => Auth::user()->api_token,
                'message' => 'Authentication Successful'
            ], 200);
        }

        return response()->json([
            'message' => "These Credentials do not match any records in our database"
        ], 422);
    }

    public function create(Request $request)
    {
    	// dd($request->get('email'));
    	$user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'api_token' => bcrypt($request->get('password') . $request->get('email')),
        ]);
    	return response()->json([], 201);
    }
}
