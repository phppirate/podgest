<?php

namespace App\Api;

use Illuminate\Http\Request;

interface ApiGateway
{
    public function allowAccessForRequest(Request $request);

    public function getUser(Request $request);
}
