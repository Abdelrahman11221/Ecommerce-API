<?php

namespace App\Http\Middleware;

use App\Http\Traits\Apidesigntrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckAdminToken
{
    use Apidesigntrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = null;
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {

                return $this->apiresponse(401 , 'INVALID_TOKEN');

            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {

                return $this->apiresponse(401 , 'EXPIRED_TOKEN');

            } else {
                return $this->apiresponse(401 , 'TOKEN_NOTFOUND');
            }
        } catch (\Throwable $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this->apiresponse(401 , 'INVALID_TOKEN');
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return $this->apiresponse(401 , 'EXPIRED_TOKEN');
            } else {
                return $this->apiresponse(401 , 'TOKEN_NOTFOUND');
            }
        }
        if(!$user){
            return $this->apiresponse(401 , 'TOKEN_NOTFOUND');
        }
        return $next($request);
    }
}
