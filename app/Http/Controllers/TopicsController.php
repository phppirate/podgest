<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;
use App\Exceptions\InvalidTopicStatusException;

class TopicsController extends Controller
{
    public function show(Topic $topic)
    {
        return response()->json([
            'topic' => $topic
        ]);
    }

    public function index()
    {
        return response()->json([
            'topics' => Topic::all(),
        ]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);
    	$topic = new Topic($request->only(['title', 'description']));
    	$topic->status = 'approved';
    	$topic->save();
    	return response()->json([
    		'id' => $topic->id,
    		'message' => 'Topic Successfully Created'
		], 201);
    }

    public function update(Topic $topic, Request $request)
    {
        if($request->has('status')){
            try {
                Topic::validateStatus($request->status);
            } catch (InvalidTopicStatusException $e) {
                return response()->json(['errors' => [
                    'status' => [
                        'status is invalid'
                    ]
                ]], 422);
            }
        }

        $topic->update($request->only('episode_id', 'title', 'description', 'status'));
        return response()->json([], 200);
    }
}
