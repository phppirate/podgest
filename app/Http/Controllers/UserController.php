<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
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
