<?php
namespace App\Http\Middleware;

use App\Http\Traits\Apidesigntrait;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;


class AssignGuard
{
    use Apidesigntrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = null): Response
    {
        if ($guard != null) {
            auth()->shouldUse($guard);
        }

        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return $this->apiResponse(400, 'User not authenticated');
            }

            $token = JWTAuth::getToken();
            $payload = JWTAuth::getPayload($token);
            $userType = $payload->get('user_type');

        } catch (JWTException $e) {
            return $this->apiResponse(400, 'Authentication failed');
        }

        Log::info('Guard: ' . $guard);
        Log::info('Authenticated User: ' . (is_object($user) ? get_class($user) : 'None'));
        Log::info('User Type: ' . $userType);

        if ($guard === 'admin-api' && $userType !== 'admin') {
            return $this->apiResponse(400, 'Unauthorized: Admin access required');
        }

        if ($guard === 'user-api' && $userType !== 'user') {
            return $this->apiResponse(400, 'Unauthorized: User access required');
        }

        return $next($request);
    }
}
