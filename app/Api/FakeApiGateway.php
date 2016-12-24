<?php

namespace App\Api;

use Illuminate\Http\Request;

class FakeApiGateway implements ApiGateway{
	public function allowAccessForRequest(Request $request)
	{
		return $request->get('api_token') === $this->getValidTestToken();
	}
	
	public function getValidTestToken()
	{
		return "valid-test-api-token";
	}
}