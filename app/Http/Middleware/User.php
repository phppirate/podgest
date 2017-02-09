<?php

namespace App\Http\Middleware;

use App\Api\ApiGateway;
use Auth;
use Closure;

class User
{
    private $apiGateway;

    public function __construct(ApiGateway $apiGateway)
    {
        $this->apiGateway = $apiGateway;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->apiGateway->allowAccessForRequest($request)) {
            return response()->json(['message' => 'Unauthorized!'], 401);
        }
        $request->user = $this->apiGateway->getUser($request);
        Auth::setUser($request->user);

        return $next($request);
    }
}
