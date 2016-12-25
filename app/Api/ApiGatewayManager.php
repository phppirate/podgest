<?php

namespace App\Api;

use App\User;
use App\Api\ApiGateway;
use Illuminate\Http\Request;

class ApiGatewayManager implements ApiGateway{
	public function allowAccessForRequest(Request $request)
	{
		return null !== $request->get('api_token');
	}
	
	public function getUser(Request $request)
	{
		if($this->allowAccessForRequest($request)){
			return User::whereApiToken($request->api_token)->firstOrFail();
		}
	}
}