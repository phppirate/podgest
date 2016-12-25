<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Api\ApiGateway;

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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->user = $this->apiGateway->getUser($request);
        Auth::setUser($request->user);
        
        return $next($request);
    }
}
