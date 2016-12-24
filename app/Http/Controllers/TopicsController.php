<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    //
    public function create(Request $request)
    {
    	$topic = new Topic($request->only(['title', 'body']));
    	$topic->status = 'approved';
    	$topic->save();
    	return response()->json([
    		'id' => $topic->id,
    		'message' => 'Topic Successfully Created'
		], 201);
    }
}
