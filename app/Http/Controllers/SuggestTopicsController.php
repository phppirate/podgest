<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class SuggestTopicsController extends Controller
{
    public function create(Request $request)
    {
    	$this->validate($request, [ 'title' => 'required' ]);
    	$topic = new Topic($request->only(['title', 'description']));
    	$request->user()->topics()->save($topic);
    	return response()->json([
    		'id' => $topic->id,
    		'message' => 'Topic Successfully Suggested'
		], 201);
    }
}
