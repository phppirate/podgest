<?php

namespace App\Api;

use App\User;
use Illuminate\Http\Request;

class FakeApiGateway implements ApiGateway
{
    public function allowAccessForRequest(Request $request)
    {
        return null !== $request->get('api_token');
    }

    public function getUser(Request $request)
    {
        if ($this->allowAccessForRequest($request)) {
            return factory(User::class)->create([
                'api_token' => $this->getValidTestAdminToken(),
                'is_admin'  => $request->get('api_token') === $this->getValidTestAdminToken(),
            ]);
        }
    }

    public function getValidTestAdminToken()
    {
        return 'valid-test-admin-api-token';
    }

    public function getValidTestUserToken()
    {
        return 'valid-test-user-api-token';
    }
}
