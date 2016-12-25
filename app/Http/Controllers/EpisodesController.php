<?php

namespace App\Http\Controllers;

use App\Episode;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public function show(Episode $episode)
    {
        return response()->json([
            'episode' => $episode,
        ]);
    }

    public function index()
    {
        return response()->json([
            'episodes' => Episode::all(),
        ]);
    }

    public function create(Request $request)
    {
    	$this->validate($request, [
    		'title' => 'required'
		]);
        
    	$episode = Episode::create($request->only(['number', 'title', 'description', 'air_date']));
    	return response()->json([
    		'id' => $episode->id,
    		'message' => "Episode Successfully Created"
		], 201);
    }
}
