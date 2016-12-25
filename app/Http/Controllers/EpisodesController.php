<?php

namespace App\Http\Controllers;

use App\Episode;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public function show($id)
    {
        if(request()->user()->isAdmin()){
            $episode = Episode::findOrFail($id);
        } else {
            $episode = Episode::Aired()->findOrFail($id);
        }
        return response()->json([
            'episode' => $episode,
        ]);
    }

    public function index()
    {
        if(request()->user()->isAdmin()){
            $episodes = Episode::all();
        } else {
            $episodes = Episode::aired()->get();
        }
        return response()->json([
            'episodes' => $episodes
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
