<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/v1/topic/suggest', 'SuggestTopicsController@create');
Route::post('/v1/topic', 'TopicsController@create')->middleware('admin:api');
Route::post('/v1/episode', 'EpisodeController@create')->middleware('admin:api');