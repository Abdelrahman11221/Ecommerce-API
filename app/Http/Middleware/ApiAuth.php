<?php

namespace App\Http\Middleware;

use App\Http\Traits\Apidesigntrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuth
{
    use Apidesigntrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dump($request->api_pass);
        // dd(env('API_PASS'));
        if($request->api_pass !== env('API_PASS')){
            return $this->apiresponse(400 , 'authentecation failed');
        }
        return $next($request);
    }
}
