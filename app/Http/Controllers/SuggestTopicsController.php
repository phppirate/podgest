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

    public function update(Topic $topic, Request $request)
    {
        if($topic->user_id != $request->user()->id){
            return response()->json([
                'message' => 'You cannot edit topics you did not create.'
            ], 422);
        }
        if($topic->status != null){
            return response()->json([
                'message' => 'You cannot edit topics that have been accepted, rejected, or marked as old.'
            ], 422);
        }
        $topic->update($request->only('title', 'description'));
        return response()->json([
            'id' => $topic->id,
            'message' => 'Topic Successfully Updated'
        ], 200);
    }
}
