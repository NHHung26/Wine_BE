<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;


use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class VerifyJWTToken
{
    public function handle($request, Closure $next)
    {
        // Log the client headers for debugging purposes


        try {
            // Check if the request contains the "Authorization" header
            $token = $request->header('Authorization');

            if (!$token) {
                return response()->json(['message' => 'Token không tồn tại'], 401);
            }

            // Try to decode the token and check its validity
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return response()->json(['message' => 'Token không hợp lệ'], 401);
            }

            // Merge the user into the request to make it accessible in controllers and other routes
            $request->merge(['user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Xảy ra lỗi trong quá trình xác minh token'], 500);
        }

        return $next($request);
    }
}
