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

Route::post('/v1/user', 'UserController@create');

Route::post('/v1/topic/suggest', 'SuggestTopicsController@create');
Route::get('/v1/topic', 'TopicsController@index');
Route::get('/v1/topic/{topic}', 'TopicsController@show');
Route::post('/v1/topic', 'TopicsController@create')->middleware('admin');
Route::patch('/v1/topic/{topic}', 'TopicsController@update')->middleware('admin');

Route::get('/v1/episode', 'EpisodesController@index')->middleware('user');
Route::get('/v1/episode/{episode}', 'EpisodesController@show')->middleware('user');
Route::post('/v1/episode', 'EpisodesController@create')->middleware('admin');