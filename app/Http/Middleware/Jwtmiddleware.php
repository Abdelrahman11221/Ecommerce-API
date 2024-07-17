<?php

namespace App\Http\Middleware;

use App\Http\Traits\Apidesigntrait;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class Jwtmiddleware
{
    use Apidesigntrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        try{
            JWTAuth::parseToken()->authenticate();
        }
        catch(Exception $e)
        {
            if($e instanceof TokenInvalidException)
            {
                return $this->apiresponse(422 , 'token invalid');
            }
            elseif($e instanceof TokenExpiredException)
            {
                return $this->apiresponse(422 , 'Token Expired');
            }
            else{
                return $this->apiresponse(422 , 'token not found');
            }
        }
        return $next($request);
    }
}
